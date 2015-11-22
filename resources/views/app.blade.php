<!DOCTYPE html>
<html lang="en">
<head>
    <title>How to Learn</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta id="token" name="token" value="{{ csrf_token() }}">
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

    @if (\Auth::user() != null)
    <a class="btn btn-success glyphicon glyphicon-th-list" v-on:click="show = !show" style="position: fixed; right: 0%; top: 20%"> NOTES</a>
    <div id="app" style=" width: 20%; position: fixed; right: 0%; top: 30%" v-if="show">
        <input v-model="newTodo" v-on:keyup.enter="addTodo" class="form-control">
        <ul class="list-group" style="margin-top: 5px; list-style: none; padding-left: 10px">
            <li v-for="todo in todos" class="list-group-item">
                <span style="font-size: 15px; font-weight: bold">@{{ todo.content }}</span>
                <span v-on:click="removeTodo($index)" class="glyphicon glyphicon-remove" style="color: red"></span>
            </li>
        </ul>
    </div>
    @endif

    <script src="/js/vue.min.js"></script>
    <script src="/js/vue-resource.min.js"></script>
    
    @yield('scripts')
    <script src="/js/algoliasearch.min.js"></script>
    
    <script>
        Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
    new Vue({
            el: 'body',
            data: { 
                query: '', 
                subjects: [],
                newTodo: '',
                todos: [],
                show: false,
                style: 'style="display: none"'
            },
            ready: function() {
                this.client = algoliasearch("Z3FQB6D6HE", "1a935447a04085b30e10986d9eca2453");
                this.index = this.client.initIndex('subjects');
                this.initialize();
            },
            methods: {
                initialize: function() {
                    this.$http.post('/users/todos/all', function(results) {
                        this.$set('todos', results);
                    });
                },
                search: function() {
                    this.index.search(this.query, function(error, results) {
                        this.subjects = results.hits;
                    }.bind(this));
                },
                addTodo: function () {
                    var content = this.newTodo.trim()
                    if (content) {
                        this.todos.push({ content: content })
                        this.newTodo = '';
                        this.$http.post('users/todos', {content: content});
                    }
                },
                removeTodo: function(index) {
                    var note = this.todos[index];
                    this.todos.splice(index, 1);                    this.$http.post('users/todos/remove', {content: note.content});
                }
            }
        });
    </script>
</body>
</html>

