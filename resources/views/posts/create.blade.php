@extends("layout.main")
@section("content")
        <div class="col-sm-8 blog-main">
            <form action="/posts" method="POST">
                {{--<input type="hidden" name="_token" value={{ csrf_field() }}>--}}
                {{ csrf_field() }}
                <div class="form-group">
                    <label>标题</label>
                    <input name="title" type="text" class="form-control" placeholder="这里是标题">
                </div>
                <div class="form-group">
                    <label>内容</label>
                    <textarea id="content"  style="height:400px;max-height:500px;" name="content" class="form-control" placeholder="这里是内容"></textarea>
                </div>
                <button type="submit" class="btn btn-default">提交</button>
            </form>

            {{--显示错误信息--}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <br>

        </div><!-- /.blog-main -->
@endsection

@section("footer")
    <footer class="blog-footer">
        <p>Blog template built for <a href="http://getbootstrap.com">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
        <p>
            <a href="#">Back to top</a>
        </p>
    </footer>
@endsection
