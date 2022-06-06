@if(Auth::user()->username != "Admin")
    <script>alert('Unauthorized.')</script>
    <script>window.location.replace('/')</script>
@endif

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Car Wash</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="img/logo.png" rel="icon">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700"
        rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/magnific-popup/magnific-popup.css" rel="stylesheet">
    <!-- Main Stylesheet File -->
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet"/>
</head>
<body id="body">
@include('navbar')

<section id="contact" class="wow fadeInUp">
    <div class="container">
        <div class="section-header">
            <h2>View Wash Types</h2>
        </div>
        <div class="row contact-info">
            <div class="col-lg-12">
                <div class="container">
                    @if(session('deletemsg'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            {{session('deletemsg')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if(session('updatemsg'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            {{session('updatemsg')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if(session('addmessage'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            {{session('addmessage')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if($errors->first('wash_type') != "")
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{$errors->first('wash_type')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if($errors->first('wash_price') != "")
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{$errors->first('wash_price')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <table class="table table-bordered table-dark" id="appts">
                        <thead>
                        <tr>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($washes as $wash)
                            <tr style="background-color: black;">
                                <td>
                                    {{$wash->type}}
                                </td>
                                <td>
                                    {{$wash->price}}
                                </td>
                                <td style="text-align: center;">
                                    <button type="button" class="btn btn-secondary" data-toggle="modal"
                                            data-target="#editModal{{$wash->id}}">
                                        Edit
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="editModal{{$wash->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: black;">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Wash Type</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form">
                                                        <form class="well" method="post" action="/editwashtype">
                                                            @csrf
                                                            <div class="control-group">
                                                                <div class="form-group">
                                                                    <input type="text" hidden value="{{$wash->id}}"
                                                                           name="washID">
                                                                    <input type="text" class="form-control"
                                                                           name="wash_type"
                                                                           value="{{$wash->type}}"/><br>
                                                                    <input type="text" class="form-control"
                                                                           name="wash_price"
                                                                           value="{{$wash->price}}"/>
                                                                    <br>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Cancel
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">Update
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#deleteModal{{$wash->id}}">
                                        Delete
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal{{$wash->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: black;">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete
                                                        Wash Type</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this wash type?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancel
                                                    </button>
                                                    <form method="post" action="/deletewashtype">
                                                        @csrf
                                                        <input type="text" hidden value="{{$wash->id}}" name="washID">
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="lib/jquery/jquery.min.js"></script>
<script src="lib/jquery/jquery-migrate.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/superfish/hoverIntent.js"></script>
<script src="lib/superfish/superfish.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/magnific-popup/magnific-popup.min.js"></script>
<script src="lib/sticky/sticky.js"></script>
<script src="js/main.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $('#appts').DataTable({
            "paging": false,
            "info": false
        });
    });
</script>
</body>
</html>
