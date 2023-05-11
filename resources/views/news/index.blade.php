@extends('layouts.app', ['page' => __('News'), 'pageSlug' => 'news'])

@section('content')
<div class="content">
    <div class="row">
    <div class="col-md-12">
        <div class="card ">

            <div class="card-header">
                <form action="{{ route('news.index') }}" method="GET">
                <div class="card">
                    <div class="card-body">
                      <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text">
                              <i class="tim-icons icon-zoom-split"></i>
                           </div>      
                         </div>
                        <input type="text" class="form-control" name="filter" placeholder="enter your search">
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
                </form>

                @if (Session::has('status_success'))
                    <div class="alert alert-success" role="alert">
                        <p>{{ Session::get('status_success') }}</p>
                    </div>
                @endif

                @if (Session::has('status_danger'))
                    <div class="alert alert-danger" role="alert">
                        <p>{{ Session::get('status_danger') }}</p>
                    </div>
                @endif

                @if (Session::has('status_warning'))
                    <div class="alert alert-warning" role="alert">
                        <p>{{ Session::get('status_warning') }}</p>
                    </div>
                @endif

                
                @if ($errors->any())
                    @foreach($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        <p>{{ $error }}</p>
                    </div>
                    @endforeach
                @endif

                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">News</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalNews">Add New</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                
                <div class="">
                    <table class="table tablesorter " id="">
                        <thead class=" text-primary">
                            <tr><th scope="col">Title</th>
                            <th scope="col">Desciption</th>
                            <th scope="col">Creation Date</th>
                            <th scope="col"></th>
                        </tr></thead>
                        <tbody>
                            @foreach ($news as $new)
                                
                            <tr>
                                <td>{{ $new->title }}</td>
                                <td>
                                    {{ $new->description }}
                                </td>
                                <td>{{ $new->created_at }}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="{{ route('news.edit', $new->id) }}">Edit</a>
                                            <a class="dropdown-item"  href="{{ route('news.delete', $new->id) }}">delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>

            <!-- Modal Add User -->
<div class="modal fade" id="modalNews" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
                  Add New                
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="tim-icons icon-simple-remove"></i>
          </button>
        </div>
        <div class="modal-body">
          
        <div class="card">
    <div class="card-body">
      
    <form class="form" method="post" action="{{ route('news.store') }}">
      @csrf
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="title" name="title"  placeholder="title">
        </div>
  
        <div class="form-group">
          <label for="description">Description</label>
          <input type="text" class="form-control" id="description" name="description"  placeholder="description">
        </div>
  
        <div class="form-group">
          <label for="content">Content</label>
          <textarea name="content" id="content" cols="57" rows="10"></textarea>
        </div>
      </div>
  </div>
  
  </div>
  <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary">Add New</button>
  </div>
  </form>
      </div>
    </div>
  </div>
          
      </div>
  </div> 
</div>
            
            <div class="card-footer py-4">
                
                <nav class="d-flex justify-content-end" aria-label="...">
                    
                </nav>
            </div>
        </div>
    </div>
    </div>
</div>

@endsection