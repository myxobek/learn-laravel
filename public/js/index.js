var App = (function()
{
    var API_TOKEN = null;

    var self = {};
    self.login = function login( email, password, onSuccess )
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
                console.log(data);
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
                console.log(data);
                if ( !$.isArray( data ) )
                {
                    data = [];
                }
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
                    }],
                    data: data
                });
            },
            'error'     : function( jqXHR, textStatus, errorThrown )
            {
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
        function(data)
        {
            App.getProducts();
        }
    );
});