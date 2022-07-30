@if($data)
<b>Selected Images</b>
    <div class="dt-responsive table-responsive">
        <table class="table table-striped table-bordered nowrap dataTable" id="order-table">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Caption</th>
                    <th>Click By</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $showdata)
                <tr>
                    <td>{{$sl++}}</td>
                    <td>
                        <textarea class="form-control" name="caption" placeholder="Write Caption"></textarea>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="click_by" placeholder="click by:">
                    </td>
                    <td>
                        <img src="{{asset('public/photoGallery')}}/{{$showdata->image}}" class="img-fluid" height="70px" width="90px">
                    </td>
                    <td>
                        <a href="#" class="btn btn-outline-danger">X</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>
@endif