
<div class="jumbotron" style="margin-top: 20px;">
      <div class="container">
        <h1>HowToLearn</h1>
        <p><a class="btn btn-primary btn-lg" href="/ask" role="button">Hỏi đáp / Đóng góp &raquo;</a></p>

        <form>
            <div class="form-group">
               <input type="search" id="search" class="form-control" placeholder="Search" v-model='query' v-on:keyup="search" class="form-control">
            </div>
        </form>

      </div>
    </div>

<div class="container">

        <ul class="list-group">
            <li class="list-group-item" v-for="subject in subjects | orderBy 'totalSearch' -1">
                <h4><a href="/subjects/@{{ subject.id }}">@{{ subject.name }}</a> (tìm kiếm <b>@{{ subject.totalSearch }}</b> lần)</h4>
            </li>
        </ul>
</div>