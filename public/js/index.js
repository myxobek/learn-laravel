var App = (function()
{
    var _api_token  = null;

    var _orderby    = 'id';
    var _direction  = 'asc';

    var self = {};
    self.init = function()
    {
        $('#table').on(
            'click',
            '.buy-product',
            function()
            {
                var product_id = +$(this).data('id');
                if( product_id > 0 )
                {
                    self.buyProduct( product_id );
                }
            }
        ).on(
            'click',
            '.sortable',
            function()
            {
                var orderBy = $(this).parent().data('field');
                var direction = 'desc';
                if( $(this).hasClass('desc') )
                {
                    direction = 'asc';
                }
                self.getProducts(orderBy, direction);
            }
        );

        $('#table').bootstrapTable({
            columns: [{
                field: 'id',
                title: 'Product ID',
                sortable: true
            }, {
                field: 'name',
                title: 'Product Name',
                sortable: true
            }, {
                field: 'price',
                title: 'Product Price',
                sortable: true
            }, {
                field: 'buy',
                title: 'Buy'
            }],
            data: [],
        });
    };

    self.login = function( email, password, onSuccess )
    {
        $.ajax({
            'dataType'  : 'json',
            'method'    : 'post',
            'data'      : {
                'email'     : email,
                'password'  : password
            },
            'timeout'   : 60000,
            'url'       : '/api/login',
            'success'   : function( data, textStatus, jqXHR )
            {
                if ( data.hasOwnProperty('api_token') )
                {
                    _api_token = data['api_token'];
                }
                onSuccess(data);
            },
            'error'     : function( jqXHR, textStatus, errorThrown )
            {
            }
        });
    };

    self.getApiToken = function()
    {
        return _api_token;
    };

    self.setApiToken = function( api_token )
    {
        _api_token = api_token;
    };

    self.getProducts = function( orderBy, direction )
    {
        _orderby    = orderBy   || _orderby;
        _direction  = direction || _direction;

        $('#table').bootstrapTable('showLoading');
        $.ajax({
            'dataType'  : 'json',
            'method'    : 'get',
            'headers'   : {
                'Authorization': 'Bearer ' + _api_token
            },
            'data'      : {
                orderBy     : _orderby,
                direction   : _direction,
            },
            'timeout'   : 60000,
            'url'       : '/api/products',
            'success'   : function( data, textStatus, jqXHR )
            {
                if ( !$.isArray( data ) )
                {
                    data = [];
                }
                $('#table').bootstrapTable('hideLoading');
                $('#table').bootstrapTable(
                    'load',
                    data
                );
            },
            'error'     : function( jqXHR, textStatus, errorThrown )
            {
            }
        });
    };

    self.buyProduct = function( product_id )
    {
        $.ajax({
            'dataType'  : 'json',
            'method'    : 'put',
            'headers'   : {
                'Authorization': 'Bearer ' + _api_token
            },
            'data'      : {},
            'timeout'   : 60000,
            'url'       : '/api/products/' + product_id + '/buy',
            'complete'  : function()
            {
                self.getProducts();
            }
        });

    };

    return self;
})();

$(document).ready(function()
{
    App.login(
        'admin@test.com',
        'foobar123',
        function()
        {
            App.init();
            App.getProducts();
        }
    );
});