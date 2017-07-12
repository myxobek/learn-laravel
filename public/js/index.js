var App = (function()
{
    var API_TOKEN = null;

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
        );

        $('#table').bootstrapTable({
            columns: [{
                field: 'id',
                title: 'Product ID'
            }, {
                field: 'name',
                title: 'Product Name'
            }, {
                field: 'price',
                title: 'Product Price'
            }, {
                field: 'buy',
                title: 'Buy'
            }],
            data: []
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
                    API_TOKEN = data['api_token'];
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
        return API_TOKEN;
    };

    self.setApiToken = function( api_token )
    {
        API_TOKEN = api_token;
    };

    self.getProducts = function()
    {
        $('#table').bootstrapTable('showLoading');
        $.ajax({
            'dataType'  : 'json',
            'method'    : 'get',
            'headers'   : {
                'Authorization': 'Bearer ' + API_TOKEN
            },
            'data'      : {},
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
                'Authorization': 'Bearer ' + API_TOKEN
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
    App.init();
    App.login(
        'admin@test.com',
        'foobar123',
        function()
        {
            App.getProducts();
        }
    );
});