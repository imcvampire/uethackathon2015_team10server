<!DOCTYPE html>
<html lang="en">
<head>
    <title>How to Learn</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>How to do</title>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <style type="text/css">
        body {
          padding-top: 50px;
          padding-bottom: 20px;
        }
    </style>
    @yield('styles')
</head>

<body>
    @include('headers.header')
    
    @yield('content')

    @include('footers.footer')
    
    @yield('scripts')
    <script src="/js/vue.min.js"></script>
    <script src="/js/algoliasearch.min.js"></script>
    <script>

        new Vue({
            el: 'body',
            data: { query: '', subjects: [] },
            ready: function() {
                this.client = algoliasearch("Z3FQB6D6HE", "1a935447a04085b30e10986d9eca2453");
                this.index = this.client.initIndex('subjects');
            },
            methods: {
                search: function() {
                    this.index.search(this.query, function(error, results) {
                        this.subjects = results.hits;
                    }.bind(this));
                }
            }
        });
    </script>
</body>
</html>

