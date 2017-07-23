<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Quickstart - Intermediate</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }
        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body >
  <div id="app">
    <table class="table">
      <tr>
        <th>Title</th>
        <th>Completed</th>
      </tr>
      <tr v-for="item in list">
        <td> @{{ item.title }}</td>
        <td> @{{ item.completed }}</td>
        <td>
          <a v-on:click.prevent="deleteTask(item.id)" class="btn btn-primary">Delete</a>
        </td>
      </tr>
    </table>
    <div class="container">
      <form name="frmTodos" class="form-horizontal" novalidate="" v-on:submit.prevent="addTodo()">
        <div class="input-group">
          <input type="text" class="form-control" id="title" name="title" v-model="task.title" placeholder="Enter Title" />
        </div>
        <div class="input-group">
          <label>Completed?</label>
          <input type="checkbox" class="form-control" id="completed" name="completed" v-model="task.completed" />
        </div>
        <input type="submit" value="Add Todo" />
      </form>
    </div>
  </div>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.2/axios.min.js"></script>
    <script src="https://unpkg.com/vue@2.4.2"></script>
    <script>
    var app = new Vue({
      el: '#app',
      data: {
        list: [],
        task: {
          title: '',
          completed: false
        }
      },
      mounted: function() {
        this.fetch();
      },
      methods: {
        fetch: function() {
          var app = this;
          axios.get('api/v1/todos').then(function (response) {
            console.log(response.data);
            app.list = response.data;
          })
        },

        addTodo: function() {
          var app = this;
          axios.post('/api/v1/todos', app.task).then(function(response) {
            console.log(response.data);
            app.task.title = '';
            app.task.completed = false;
            app.fetch();
          })
          .catch(function (error) {
            console.log(error);
          })
        },

        deleteTask: function(id) {
          var app = this;
          console.log('api/v1/todos/' + id);
          axios.delete('api/v1/todos/' + id).then(function(response) {
            console.log(response.data);
            app.fetch();
          })
          .catch(function (error) {
            console.log(error)
          });
        }
      }
    })
    </script>
</body>
</html>
