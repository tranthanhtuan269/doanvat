@extends('layouts.layout')

@section('content')
    <div class="container show-curriculum-vitae-page" style="margin-top: 20px;">
        <div class="row">
            <div class="col-md-8">            
                <div class="row curriculumvitae">
                    <div class="col-md-12">
                        <div class="row main-top">
                            <div class="col-md-5">
                                @if(strlen($curriculumvitae->avatar) > 3)
                                <img src="http://test.gmon.com.vn/?image={{ $curriculumvitae->avatar }}" width="200" height="200" class="img-circle
                                ">
                                @else
                                <img src="http://test.gmon.com.vn/?image=avatar.png" width="200" height="200" class="img-circle
                                ">
                                @endif
                            </div>
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="text-upper">{{ $curriculumvitae->name }}</h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        Ngày sinh: {{ $curriculumvitae->birthday }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        Giới tính: @if($curriculumvitae->gender == 0) Nữ @else Nam @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        Tỉnh / Thành phố: {{ $curriculumvitae->city }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        Quận / Huyện: {{ $curriculumvitae->district }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(strlen($curriculumvitae->education) > 3)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">Quá trình học tập</div>
                                    <div class="panel-body">
                                        <?php 
                                            $curriculumvitae->education = ltrim($curriculumvitae->education, ';');
                                            $educations = explode(";",$curriculumvitae->education);
                                            foreach ($educations as $education) {
                                            $edu = json_decode($education);
                                        ?>
                                        <div class="row">
                                            <div class="col-md-4">Trường học </div>
                                            <div class="col-md-4">{{ $edu->truong_hoc }}</div>
                                            <div class="col-md-4">@if( $edu->student_process == 0) Đang học @else Đã tốt nghiệp @endif</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">Thời gian học </div>
                                            <div class="col-md-4">Từ {{ ($edu->thang_bat_dau > 0 && $edu->thang_bat_dau < 10) ? '0' . $edu->thang_bat_dau . '/' : '' }}{{ ($edu->thang_bat_dau > 0 && $edu->thang_bat_dau > 9) ? '' . $edu->thang_bat_dau . '/' : '' }}{{ $edu->nam_bat_dau }} </div>
                                            <div class="col-md-4">@if( $edu->student_process == 0) Đến nay @else Đến {{ ($edu->thang_ket_thuc > 0 && $edu->thang_ket_thuc < 10) ? '0' . $edu->thang_ket_thuc . '/' : '' }}{{ ($edu->thang_ket_thuc > 0 && $edu->thang_ket_thuc > 9) ? '' . $edu->thang_ket_thuc . '/' : '' }}{{ $edu->nam_ket_thuc }} @endif </div>
                                        </div>
                                        @if( $edu->bang_cap != 2 && $edu->chuyen_nganh != "")
                                        <div class="row">
                                            <div class="col-md-4">Chuyên ngành </div>
                                            <div class="col-md-8">{{ $edu->chuyen_nganh }} </div>
                                        </div>
                                        @endif
                                        @if(isset($edu->loai_tot_nghiep) && $edu->loai_tot_nghiep != "--Chọn Loại tốt nghiệp--" && $edu->loai_tot_nghiep != "Chọn Loại tốt nghiệp")
                                        <div class="row">
                                            <div class="col-md-4">Thành tích học tập </div>
                                            <div class="col-md-8">{{ $edu->loai_tot_nghiep }}</div>
                                        </div>
                                        @endif
                                        <hr>
                                        <?php 
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(strlen($curriculumvitae->word_experience) > 3)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">Kinh nghiệm làm việc</div>
                                    <div class="panel-body">
                                        <?php 
                                            $curriculumvitae->word_experience = ltrim($curriculumvitae->word_experience, ';');
                                            if(substr($curriculumvitae->word_experience, -1) == ';'){
                                                $curriculumvitae->word_experience=rtrim($curriculumvitae->word_experience,";");
                                            }
                                            $word_experiences = explode(";",$curriculumvitae->word_experience);
                                            foreach ($word_experiences as $word_experience) {
                                            $exp = json_decode($word_experience);
                                        ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-5">Vị trí công việc</div>
                                                    <div class="col-md-7">{{ $exp->vi_tri }}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">Tên đơn vị đã làm</div>
                                                    <div class="col-md-7">{{ $exp->ten_cong_ty }}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">Thời gian làm</div>
                                                    <div class="col-md-7">Từ {{ $exp->thang_bat_dau_lam_viec }}/{{ $exp->nam_bat_dau_lam_viec }} Đến {{ $exp->thang_ket_thuc_lam_viec }}/{{ $exp->nam_ket_thuc_lam_viec }}</div>
                                                </div>
                                                @if(strlen($exp->mo_ta) > 0)
                                                <div class="row">
                                                    <div class="col-md-5">Mô tả công việc</div>
                                                    <div class="col-md-7">{{ $exp->mo_ta }}</div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <hr>
                                        <?php 
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(strlen($curriculumvitae->qualification) > 3)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">Kỹ năng</div>
                                    <div class="panel-body">
                                        <div class="row">
                                        <?php 
                                            $curriculumvitae->qualification = ltrim($curriculumvitae->qualification, ';');
                                            $qualifications = explode(";",$curriculumvitae->qualification);
                                        ?>
                                            <div class="col-md-12">
                                                @if(count($qualifications) > 1)
                                                @for ($i = 0; $i < count($qualifications); $i++)
                                                    <?php 
                                                        $qual = json_decode($qualifications[$i]);
                                                        echo ' - ' . $qual->ten_ky_nang . '<br />';
                                                    ?>
                                                @endfor
                                                @else
                                                    <?php 
                                                    $qual = json_decode($qualifications[0]);
                                                    echo $qual->ten_ky_nang;
                                                    ?>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(strlen($curriculumvitae->language) > 3)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">Ngoại ngữ</div>
                                    <div class="panel-body">
                                        <?php 
                                            $curriculumvitae->language = ltrim($curriculumvitae->language, ';');
                                            $languages = explode(";",$curriculumvitae->language);
                                            foreach ($languages as $language) {
                                            $lang = json_decode($language);
                                        ?>
                                        <div class="row">
                                            <div class="col-md-6">{{ $lang->ten_ngoai_ngu }}</div>
                                            <div class="col-md-6">{{ $lang->trinh_do_ngoai_ngu }}</div>
                                        </div>
                                        <hr>
                                        <?php 
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">Sở thích</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12"><?php echo $curriculumvitae->interests; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">Tính cách</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12"><?php echo $curriculumvitae->references; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(strlen($curriculumvitae->career_objective) > 1)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">Mục đích làm việc?</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                            <?php 
                                                echo $curriculumvitae->career_objective;
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">Hoạt động ngoại khóa</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12"><?php echo $curriculumvitae->active; ?></div>
                                        </div>
                                        <div class="row">
                                            <?php 
                                                if(strlen($curriculumvitae->images) > 0){
                                                    $curriculumvitae->images = rtrim($curriculumvitae->images,";");
                                                    $images = explode(";",$curriculumvitae->images);
                                                    $i = 0;
                                                    foreach ($images as $image) {
                                                        $i++;
                                                        if($i%4 == 0) break;
                                            ?>
                                            <div class="col-md-4"><img id="image-{{ $i }}" class="image-cv" data-id="{{ $i }}" src="http://test.gmon.com.vn/?image={{ $image }}" width="100%" height="102"></div>
                                            <?php 
                                            }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="btn btn-danger pull-right" style="display:none;">In hồ sơ</div>
                                <div class="btn btn-primary pull-right" style="display:none;">Lưu hồ sơ</div>
                                @if(Auth::check())
                                    @if($curriculumvitae->user == Auth::user()->id)
                                    <a class="btn btn-primary pull-right" href="{{ url('/') }}/curriculumvitae/{{ $curriculumvitae->id }}/edit">Sửa hồ sơ</a>
                                    @else
                                    <div class="btn btn-primary pull-right" data-toggle="modal" data-target="#danh-gia">Đánh giá ứng viên</div>
                                    @endif
                                @else
                                    <div class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal" onclick="onOpenLogin()">Đánh giá ứng viên</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="cv-btn-holder">
                            <div class="btn btn-primary">Lưu hồ sơ</div>
                            <div class="btn btn-warning pull-right">Xem thông tin liên hệ ( -3 điểm )</div>
                        </div>
                    </div>
                </div>
                <div class="row cv-info-holder">
                    <div class="col-md-2 cv-info">Xem <div>160</div></div>
                    <div class="col-md-3 text-center cv-info">Tải xuống <div>160</div></div>
                    <div class="col-md-4 text-center cv-info">Tải thành công <div>100%</div></div>
                    <div class="col-md-3 text-right cv-info">Cập nhật <div>07/2017</div></div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="cv-rate-holder">
                            <div class="rate-holder-label">Đánh giá ứng viên</div>
                            <p class="star-vote text-center" id="star-vote-current">
                                <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-1" class="vote">
                                <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-2" class="vote">
                                <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-3" class="vote">
                                <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-4" class="vote">
                                <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-5" class="vote">
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="cv-rates-holder">
                            <div class="rate-holders-label">Nhà tuyển dụng nói gì?</div>
                            <div class="content-rates">
                                @foreach($commentCurriculumVitaes as $commentCurriculumVitae)
                                <div class="content-rate">
                                    <p class="star-vote" id="star-vote-by-company">
                                        <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-1" class="vote">
                                        <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-2" class="@if(intval($commentCurriculumVitae->star) > 1) vote @else no-vote @endif">
                                        <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-3" class="@if(intval($commentCurriculumVitae->star) > 2) vote @else no-vote @endif">
                                        <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-4" class="@if(intval($commentCurriculumVitae->star) > 3) vote @else no-vote @endif">
                                        <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-5" class="@if(intval($commentCurriculumVitae->star) > 4) vote @else no-vote @endif">
                                    </p>
                                    <div class="rate-comment">
                                        {{ $commentCurriculumVitae->description }}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="cv-rates-holder">
                            <div class="rate-holders-label">Ứng viên khác nói gì?</div>
                            <div class="content-rates">
                                @foreach($commentCurriculumVitaes as $commentCurriculumVitae)
                                <div class="content-rate">
                                    <p class="star-vote" id="star-vote-by-company">
                                        <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-1" class="vote">
                                        <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-2" class="@if(intval($commentCurriculumVitae->star) > 1) vote @else no-vote @endif">
                                        <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-3" class="@if(intval($commentCurriculumVitae->star) > 2) vote @else no-vote @endif">
                                        <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-4" class="@if(intval($commentCurriculumVitae->star) > 3) vote @else no-vote @endif">
                                        <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-5" class="@if(intval($commentCurriculumVitae->star) > 4) vote @else no-vote @endif">
                                    </p>
                                    <div class="rate-comment">
                                        {{ $commentCurriculumVitae->description }}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="danh-gia" tabindex="-1" role="dialog" aria-labelledby="danhgiaLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center" id="myModalLabel">Đánh giá ứng viên</h4>
          </div>
          <div class="modal-body">
                <form class="form-horizontal">
                <input type="hidden" name="curriculumvitae" value="{{ $curriculumvitae->id }}">
                <input type="hidden" name="score" value="3">
                <div class="form-group">
                    <div class="col-sm-12 text-center">
                        <p class="star-vote" id="star-vote">
                            <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-1" class="vote">
                            <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-2" class="vote">
                            <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-3" class="vote">
                            <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-4" class="no-vote">
                            <img src="http://test.gmon.com.vn/?image=star.png" alt="" id="star-vote-5" class="no-vote">
                        </p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <textarea class="form-control" rows="5" id="inputDescription">Nói cho mọi người biết điều bạn nghĩ về ứng viên</textarea>
                    </div>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <div class="pull-left message-danh-gia">Hãy cho chúng tôi biết về điều bạn thích và không thích</div>
            <button type="button" class="btn btn-primary" id="send-message">Gửi đánh giá</button>
          </div>
        </div>
      </div>
    </div>
    <!-- The Modal -->
    <div id="myModal" class="modal">

      <!-- The Close Button -->
      <span class="previous_btn">&lt;</span>
      <span class="next_btn">&gt;</span>
      <span class="close">&times;</span>

      <!-- Modal Content (The Image) -->
      <img class="modal-content" id="img01">
    </div>
    <style type="text/css">

        /* The Modal (background) */
        #myModal.modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
        }

        /* Modal Content (Image) */
        #myModal .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image (Image Text) - Same Width as the Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation - Zoom in the Modal */
        #myModal .modal-content, #caption { 
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {-webkit-transform:scale(0)} 
            to {-webkit-transform:scale(1)}
        }

        @keyframes zoom {
            from {transform:scale(0)} 
            to {transform:scale(1)}
        }

        /* The Close Button */
        .next_btn {
            position: fixed;
            top: 210px;
            left: 1098px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
            z-index: 56;
        }

        .next_btn:hover,
        .next_btn:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* The Close Button */
        .previous_btn {
            position: fixed;
            top: 205px;
            left: 200px; 
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .previous_btn:hover,
        .previous_btn:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
            .modal-content {
                width: 100%;
            }
        }
    </style>
    <script type="text/javascript">
        var $curr_image = 1;
        $('.image-cv').click(function(){
            $('#myModal').show();
            $curr_image = $(this).attr('data-id');
            if($curr_image - 1 <= 0){
                $('.previous_btn').hide();
            }else{
                $('.previous_btn').show();
            }
            if($curr_image >= $('.image-cv').length){
                $('.next_btn').hide();
            }else{
                $('.next_btn').show();
            }
            $('#img01').attr('src', $(this).attr('src'));
        });

        // When the user clicks on <span> (x), close the modal
        $('#img01').click(function() { 
          $('#myModal').hide();
        });

        // When the user clicks on <span> (x), close the modal
        $('.close').click(function() { 
          $('#myModal').hide();
        });

        $('.previous_btn').click(function(){
            $('#myModal').hide();
            $curr_image--;
            if($curr_image - 1 <= 0){
                $(this).hide();
            }else{
                $(this).show();
            }
            $('.next_btn').show();
            $('#img01').attr('src', $('#image-' + $curr_image).attr('src'));
            $('#myModal').show();
        });

        $('.next_btn').click(function(){
            $('#myModal').hide();
            $curr_image++;
            if($curr_image >= $('.image-cv').length){
                $(this).hide();
            }else{
                $(this).show();
            }
            $('.previous_btn').show();
            $('#img01').attr('src', $('#image-' + $curr_image).attr('src'));
            $('#myModal').show();
        });

        $(document).ready(function(){
            $('#inputDescription').click(function(){
                if($('#inputDescription').val() == 'Nói cho mọi người biết điều bạn nghĩ về ứng viên'){
                    $('#inputDescription').val('');
                }
            });

            $('#star-vote img').click(function () {
                switch ($(this).attr('id')) {
                    case 'star-vote-1':
                        $('#star-vote img#star-vote-1').removeClass('no-vote').addClass('vote');
                        $('#star-vote img#star-vote-2').removeClass('vote').addClass('no-vote');
                        $('#star-vote img#star-vote-3').removeClass('vote').addClass('no-vote');
                        $('#star-vote img#star-vote-4').removeClass('vote').addClass('no-vote');
                        $('#star-vote img#star-vote-5').removeClass('vote').addClass('no-vote');
                        break;
                    case 'star-vote-2':
                        $('#star-vote img#star-vote-1').removeClass('no-vote').addClass('vote');
                        $('#star-vote img#star-vote-2').removeClass('no-vote').addClass('vote');
                        $('#star-vote img#star-vote-3').removeClass('vote').addClass('no-vote');
                        $('#star-vote img#star-vote-4').removeClass('vote').addClass('no-vote');
                        $('#star-vote img#star-vote-5').removeClass('vote').addClass('no-vote');
                        break;
                    case 'star-vote-3':
                        $('#star-vote img#star-vote-1').removeClass('no-vote').addClass('vote');
                        $('#star-vote img#star-vote-2').removeClass('no-vote').addClass('vote');
                        $('#star-vote img#star-vote-3').removeClass('no-vote').addClass('vote');
                        $('#star-vote img#star-vote-4').removeClass('vote').addClass('no-vote');
                        $('#star-vote img#star-vote-5').removeClass('vote').addClass('no-vote');
                        break;
                    case 'star-vote-4':
                        $('#star-vote img#star-vote-1').removeClass('no-vote').addClass('vote');
                        $('#star-vote img#star-vote-2').removeClass('no-vote').addClass('vote');
                        $('#star-vote img#star-vote-3').removeClass('no-vote').addClass('vote');
                        $('#star-vote img#star-vote-4').removeClass('no-vote').addClass('vote');
                        $('#star-vote img#star-vote-5').removeClass('vote').addClass('no-vote');
                        break;
                    case 'star-vote-5':
                        $('#star-vote img#star-vote-1').removeClass('no-vote').addClass('vote');
                        $('#star-vote img#star-vote-2').removeClass('no-vote').addClass('vote');
                        $('#star-vote img#star-vote-3').removeClass('no-vote').addClass('vote');
                        $('#star-vote img#star-vote-4').removeClass('no-vote').addClass('vote');
                        $('#star-vote img#star-vote-5').removeClass('no-vote').addClass('vote');
                        break;
                    default:
                        break;
                }
            });

            $('#send-message').click(function(){
                var countStar = $('#star-vote>img.vote').length;
                var description = $('#inputDescription').val();
                var curriculumvitae = $('input[name=curriculumvitae]').val()
                var request = $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('/') }}/curriculumvitae/send-comment",
                    method: "POST",
                    data: {
                        'curriculumvitae': curriculumvitae,
                        'description': description,
                        'countStar': countStar,
                    },
                    dataType: "json"
                });

                request.done(function (msg) {
                    if (msg.code == 200) {
                        $('#add-comment').modal('toggle');
                        swal("Thông báo", "Thêm đánh giá thành công!", "success");
                    } else {
                        $('#add-comment').modal('toggle');
                        swal("Cảnh báo", msg.message, "error");
                    }
                });

                request.fail(function (jqXHR, textStatus) {
                    swal("Cảnh báo", textStatus, "error");
                });
            });
        });
    </script>
@endsection