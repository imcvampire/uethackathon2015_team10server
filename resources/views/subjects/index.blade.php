@extends('app')

@section('content')
    <div class="jumbotron">
      <div class="container">
        <h1>HowToLearn </h1>
        <p>Bạn muốn học một thứ nhưng không biết bắt đầu từ đâu?</p>
        <p>Bạn cảm thấy choáng ngợp trước lượng thông tin khổng lồ và không biết phải bắt đầu như thế nào?</p>
        <p>HowToLearn sẽ giúp bạn giải quyết điều đó</p>
        <p><a class="btn btn-primary btn-lg" href="/ask" role="button">Hỏi đáp / Đóng góp &raquo;</a></p>

        <form style="margin-top: 20px">
            <div class="form-group has-feedback">
                <i class="glyphicon glyphicon-search form-control-feedback" style="font-size: 20px; padding-top: 10px"></i>
               <input type="search" id="search" class="form-control" placeholder="Search" v-model='query' v-on:keyup="search" class="form-control" style="height: 50px">
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
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
          <h2>Tiết kiệm thời gian</h2>
          <p style="text-align: justify">Bạn sẽ tìm thấy những gì tốt nhất dành cho mình để bắt đầu mà không phải tốn hàng giờ tìm kiếm mà không đi đến đâu. Việc học hành của bạn sẽ dễ dàng hơn bao giờ hết.
          </p>
        </div>
        <div class="col-md-4">
          <h2>Thân thiện</h2>
          <p style="text-align: justify">Bạn không tìm thấy thứ bạn muốn học? Không hề gì! Hãy gửi câu hỏi đến chúng tôi và nhận câu trả lời từ những thành viên uy tín nhất</p>
       </div>
        <div class="col-md-4">
          <h2>Tạo hứng thú</h2>
          <p style="text-align: justify">Bạn đã học xong rồi vào cảm thấy lập tức muốn học thêm một thứ gì đó hay áp dụng những gì vừa học? Hãy cùng chia sẻ với chúng tôi những thành công ban đầu của bạn!</p>
        </div>
      </div>

      <hr>

    </div> <!-- /container -->

@stop

@section('scripts')
	<script src="/js/jquery.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	

@stop

