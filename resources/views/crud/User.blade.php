@extends('layouts.AdminMaster')

        @section('konten')
        <div class="page-wrapper ">
                <div data-aos="flip-up"  class="container-fluid">
                    <div class="row page-titles">
                        <div class="col-md-5 col-8 align-self-center">
                            <h3 class="text-themecolor m-b-0 m-t-0">Users</h3>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">CRUD USER</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-12">
                            <div class="card">
                                <div class="card-block">
                                    <div class="table-responsive">
                                        <h2>Crud user</h2><br>
                                        <a class="btn btn-success" id="showTambah" >Tambah Data</a><br><br>
                                        <table class="table" id="myData">
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>username</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                                    <tbody>
                                                    </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- FORM TAMBAH --}}
                    <form id="formAdd" data-aos="fade-left" style="display:none" class="form-horizontal form-material">
                                <div class="col-lg-11 col-xlg-12 col-md-10">
                                    <div class="card">
                                        <div class="card-block">
                                        <h4>Detail Data</h4>
                                            <div class="form-group">
                                                    <label class="col-md-12">Username</label>
                                                    <div class="col-md-12">
                                                        <input type="text" id="username" placeholder="username" name="username" class="form-control form-control-line">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12">Password</label>
                                                    <div class="col-md-12">
                                                        <input type="text" id="password" placeholder="password" name="password" class="form-control form-control-line">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12">Konfirmasi Password</label>
                                                    <div class="col-md-12">
                                                        <input type="text" id="cpassword" placeholder="confirmation password" name="password_confirmation" class="form-control form-control-line">
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <button type="submit" class="btn btn-success">Tambah</button>
                                                        <input type="reset" onclick="$('#preview').hide();$('.notiferror').detach();" class="btn btn-success" value="Reset">
                                                        <a href="" class="btn btn-success" id="hideTambah" >Cancel</a><br><br>
                                                    </div>
                                                <div id="pesanbox"></div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                </form>


                    {{-- END FORM TAMBAH --}}
                     <!-- Form Edit -->
            <form id="formEdit" style="display:none" class="form-horizontal form-material">
                    <input type="hidden" name="id" id="id2">
                        <div class="col-lg-11 col-xlg-12 col-md-10">
                            <div class="card">
                                <div class="card-block">
                                <h4>Detail Data</h4>
                                <div class="form-group">
                                    <label class="col-md-12">Username</label>
                                    <div class="col-md-12">
                                        <input type="text" id="username2" readonly placeholder="username" name="username" class="form-control form-control-line">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Password</label>
                                    <div class="col-md-12">
                                        <input type="text" id="password2" placeholder="password" name="password" class="form-control form-control-line">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Konfirmasi Password</label>
                                    <div class="col-md-12">
                                        <input type="text" id="cpassword2" placeholder="confirmation password" name="password_confirmation" class="form-control form-control-line">
                                    </div>
                                </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-success">Edit</button>
                                                <a href="" class="btn btn-success" id="hideEdit" >Cancel</a><br><br>
                                            </div>
                                        <div id="pesanbox2"></div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        </form>
                   <!-- END FORM Edit -->
                </div>
                <footer class="footer"> © 2019 iqbalcakep </footer>
            </div>

        @endsection

        @section('script')
        <script type="text/javascript" src="js/User.js" ></script>
        @endsection