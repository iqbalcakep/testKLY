@extends('layouts.AdminMaster')

        @section('konten')
        <div class="page-wrapper ">
                <div data-aos="flip-up"  class="container-fluid">
                    <div class="row page-titles">
                        <div class="col-md-5 col-8 align-self-center">
                            <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-12">
                            <div class="card">
                                <div class="card-block">
                                    <div class="table-responsive">
                                        <h2>My Data</h2><br>
                                        <a class="btn btn-success" id="showTambah" >Tambah Data</a><br><br>
                                        <table class="table" id="myData">
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Tanggal Lahir</th>
                                                    <th>No HP</th>
                                                    <th>Kelamin</th>
                                                    <th>Gambar</th>
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
                                                    <label class="col-md-12">Nama</label>
                                                    <div class="col-md-12">
                                                        <input type="text" id="nama" placeholder="nama" name="nama" class="form-control form-control-line">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12">Email</label>
                                                    <div class="col-md-12">
                                                        <input type="text" placeholder="Email" id="email" name="email" class="form-control form-control-line">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12">Lahir</label>
                                                    <div class="col-md-12">
                                                        <input type="date" placeholder="yyyy-mm-dd" id="tanggal_lahir" name="tanggal_lahir" class="form-control form-control-line">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12">No HP</label>
                                                    <div class="col-md-12">
                                                            <input type="text" placeholder="nohp" id="nohp" name="nohp" class="form-control form-control-line">
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                        <label class="col-md-12">Kelamin</label>
                                                        <div class="col-md-12">
                                                               <select id="kelamin" name="kelamin">
                                                                   <option value="">Pilih Kelamin</option>
                                                                   <option id="male" value="male">MALE</option>
                                                                   <option id="female" value="female">FEMALE</option>
                                                               </select>
                                                        </div>
                                                    </div>
                                                <div class="form-group">
                                                    <div id="previewedit"></div>
                                                    <img id="preview" style="display:none" class="img-circle" width="150" height="150px" />
                                                    <h4 class="card-title m-t-10"><input type="file" name="gambar" id="gambar"></h4>
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
                                            <label class="col-md-12">Nama</label>
                                            <div class="col-md-12">
                                                <input type="text" id="nama2" placeholder="nama" name="nama" class="form-control form-control-line">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Email</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="Email" id="email2" name="email" class="form-control form-control-line">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Lahir</label>
                                            <div class="col-md-12">
                                                <input type="date" placeholder="yyyy-mm-dd" id="tanggal_lahir2" name="tanggal_lahir" class="form-control form-control-line">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">No HP</label>
                                            <div class="col-md-12">
                                                    <input type="text" placeholder="nohp" id="nohp2" name="nohp" class="form-control form-control-line">
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <label class="col-md-12">Kelamin</label>
                                                <div class="col-md-12">
                                                       <select id="kelamin2" name="kelamin">
                                                           <option id="male2" value="male">MALE</option>
                                                           <option id="female2" value="female">FEMALE</option>
                                                       </select>
                                                </div>
                                            </div>
                                        <div class="form-group">
                                            <div id="previewedit2"></div>
                                            <img id="preview2" style="display:none" class="img-circle" width="150" height="150px" />
                                            <h4 class="card-title m-t-10"><input type="file" name="gambar" id="gambar2"></h4>
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
        <script type="text/javascript" src="js/Dashboard.js" ></script>
        @endsection