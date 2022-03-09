{{-- resources/views/welcome.blade.php --}}
@extends('layouts.app')

@section('content')

<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

  <script>
   let BASE_URL = "http://127.0.0.1:8000/leaderboard";
const getTodoItems = async () => {
  try {
    const response = await axios.get(`${BASE_URL}`);
    const e = document.createElement("ul");

    const todoItems = response.data;
    const Sort = todoItems.sort((a, b) => b.score - a.score);

    Sort.forEach(function (color) {
      e.innerHTML += `<li id="${color.name}"">${color.name} : ${color.score}</li>`;
      document.body.appendChild(e);
    });
    Pusher.logToConsole = true;

    var pusher = new Pusher("661bc3c0e679dc50b275", {
      cluster: "eu",
    });
    var channel = pusher.subscribe("leaderboard");
    channel.bind("App\\Events\\ScoreUpdated", function (data) {
      alert(JSON.stringify(data));
      var element = document.getElementById(data.name);
      if(element){
        element.parentNode.removeChild(element);
      e.innerHTML += `<li id="${data.name}">${data.name} : ${data.score}</li>`;
  }else{
    e.innerHTML += `<li id="${data.name}">${data.name} : ${data.score}</li>`;
    todoItems.push(data);
  }
      
    });
  } catch (errors) {
    console.error(errors);
  }
  };
getTodoItems();


  </script>
       
</head>
<body>
  <div>
    <h1>Todos</h1>
    <ul>

    </ul>
  </div>

@endsection