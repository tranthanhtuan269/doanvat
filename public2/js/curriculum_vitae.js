$(document).ready(function () {
    $('.panel-heading').click(function(){
        $(this).parent().find('.panel-body').toggle();
    });
    CKEDITOR.replace('interests');
    CKEDITOR.replace('references');
    CKEDITOR.replace('career_objective');
    CKEDITOR.replace('active');
    var url_site = $('base').attr('href');
    var count_hoc_tap = 0;
    var count_kinh_nghiem = 0;
    var count_language = 0;
    var count_qualification = 0;
    $('#add-qualification').click(function () {
        if ($('#ten_ky_nang').val().length <= 1) {
            swal("Tên kỹ năng trống!", "Xin hãy điền tên kỹ năng trước khi thêm mới!");
            return false;
        }

        renderJsonKyNang();
        count_qualification++;
        var html = "<label for='ten_ky_nang' class='col-md-4 qualification-holder' id='qualification-" + count_qualification + "'><div class='col-md-12'>";
        html += " - <span class='ngoai-ngu'>" + $('#ten_ky_nang').val() + "</span>";
        html += "<span class='qualification-delete' id='qualification-delete-" + count_qualification + "'>&nbsp;x&nbsp;</span></div></label>";
        $(html).appendTo('#qualification_content');
        $('.qualification-delete').off('click');
        $('.qualification-delete').click(function () {
            var id_obj = $(this).attr('id');
            id_obj = id_obj.substring(21, id_obj.length);
            $('#qualification-' + id_obj).remove();
            re_render_qualification(id_obj);
            count_qualification--;
        });
        
        $('#ten_ky_nang').val('');
        
    });

    $('#add-language').click(function () {
        if ($('#ten_ngoai_ngu').val().length <= 1) {
            swal("Tên ngoại ngữ trống!", "Xin hãy điền tên ngoại ngữ trước khi thêm mới!");
            return false;
        }

        if ($('#trinh_do_ngoai_ngu').val().length <= 0) {
            swal("Trình độ ngoại ngữ trống!", "Xin hãy điền trình độ ngoại ngữ trước khi thêm mới!");
            return false;
        }

        renderJsonNgoaiNgu();

        count_language++;
        var html = "<label for='ten_ngoai_ngu' class='col-md-4' id='language-" + count_language + "'><div class='col-md-12'>";
        html += " - <span class='ngoai-ngu'>" + $('#ten_ngoai_ngu').val() + "</span> - Trình độ: <span class='ngoai-ngu'>" + $('#trinh_do_ngoai_ngu').val() + "</span>";
        html += "<span class='language-delete' id='language-delete-" + count_language + "'>&nbsp;x&nbsp;</span></div></label>";
        $(html).appendTo('#ngoai_ngu_content');
        $('.language-delete').off('click');
        $('.language-delete').click(function () {
            var id_obj = $(this).attr('id');
            id_obj = id_obj.substring(16, id_obj.length);
            $('#language-' + id_obj).remove();
            re_render_language(id_obj);
            count_language--;
        });
        
        $('#ten_ngoai_ngu').val('');
        $('#trinh_do_ngoai_ngu').val('');
    });
    function validate_kinh_nghiem_cu(id) {
        if ($('#ten_cong_ty_' + id).val().length <= 0) {
            swal("Tên công ty không được để trống!", "Xin hãy điền Tên công ty!");
            return false;
        }

        if ($('#vi_tri_' + id).val().length <= 0) {
            swal("Vị trí công việc không được để trống!", "Xin hãy điền Vị trí công việc!");
            return false;
        }

        if ($('#nam_bat_dau_lam_viec_' + id).val() <= 0) {
            swal("Năm bắt đầu công việc không được bỏ trống!", "Xin hãy chọn Năm bắt đầu công việc!");
            return false;
        }

        if ($('#nam_ket_thuc_lam_viec_' + id).val() <= 0) {
            swal("Năm kết thúc công việc không được bỏ trống!", "Xin hãy chọn Năm kết thúc công việc!");
            return false;
        }

        if ($('#thang_bat_dau_lam_viec_' + id).val() <= 0) {
            swal("Tháng bắt đầu công việc không được bỏ trống!", "Xin hãy chọn Tháng bắt đầu công việc!");
            return false;
        }

        if ($('#thang_ket_thuc_lam_viec_' + id).val() <= 0) {
            swal("Tháng kết thúc công việc không được bỏ trống!", "Xin hãy chọn Tháng kết thúc công việc!");
            return false;
        }

        if (parseInt($('#nam_bat_dau_lam_viec_' + id).val()) > parseInt($('#nam_ket_thuc_lam_viec_' + id).val())) {
            swal("Năm bắt đầu lớn hơn Năm kết thúc!", "Xin hãy chọn lại Năm bắt đầu và Năm kết thúc!");
            return false;
        }

        if (parseInt($('#nam_bat_dau_lam_viec_' + id).val()) == parseInt($('#nam_ket_thuc_lam_viec_' + id).val())) {
            if (parseInt($('#thang_bat_dau_lam_viec_' + id).val()) > parseInt($('#thang_ket_thuc_lam_viec_' + id).val())) {
                swal("Tháng bắt đầu lớn hơn Tháng kết thúc!", "Xin hãy chọn lại Tháng bắt đầu và Tháng kết thúc!");
                return false;
            }
        }

        // if ($('#dia_chi_cong_ty_' + id).val().length <= 0) {
        //     swal("Địa chỉ công ty không được để trống!", "Xin hãy điền Địa chỉ công ty!");
        //     return false;
        // }

        // if ($('#thanh_pho_' + id).val() <= 0) {
        //     swal("Thành phố nơi làm việc không được để trống!", "Xin hãy điền Thành phố nơi làm việc!");
        //     return false;
        // }

        // if ($('#quan_huyen_' + id).val() <= 0) {
        //     swal("Quận / Huyện nơi làm việc không được để trống!", "Xin hãy điền Quận / Huyện nơi làm việc!");
        //     return false;
        // }

        // if ($('#mo_ta_' + id).val().length <= 0) {
        //     swal("Mô tả ngắn không được để trống!", "Xin hãy điền Mô tả ngắn!");
        //     return false;
        // }

        return true;
    }

    $('#them_moi_kinh_nghiem').click(function () {
        if (!validate_kinh_nghiem_cu(count_kinh_nghiem)) {
            swal("Kinh nghiệm trước chưa được hoàn thành!", "Xin hãy hoàn thành kinh nghiệm trước để có thể thêm mới!");
            return false;
        }
        count_kinh_nghiem++;
        var html = "";
        html += "<div class='form-kinh-nghiem-group' id='kinh_nghiem_lam_viec_" + count_kinh_nghiem + "'>";
        html += "<input type='hidden' class='word_experience_json' id='kinh_nghiem_lam_viec_" + count_kinh_nghiem + "_json' value=''>";
        html += "<div id='kinh_nghiem_lam_viec_" + count_kinh_nghiem + "_content'>";
        html += "<input type='hidden' id='lam_viec_" + count_kinh_nghiem + "_image' value=''>";
        html += "<div class='form-group'>";
        html += "<div class='col-md-6'>";
        html += "<label for='ten_cong_ty' class='col-md-4 control-label'>Tên công ty đã làm</label>";
        html += "<div class='col-md-8'>";
        html += "<input type='text' class='form-control' class='ten_cong_ty' id='ten_cong_ty_" + count_kinh_nghiem + "'>";
        html += "</div>";
        html += "</div>";
        html += "<div class='col-md-6'>";
        html += "<label for='vi_tri' class='col-md-4 control-label'>Vị trí công việc</label>";
        html += "<div class='col-md-8'>";
        html += "<input type='text' class='form-control' class='vi_tri' id='vi_tri_" + count_kinh_nghiem + "'>";
        html += "</div>";
        html += "</div>";
        html += "</div>";
        html += "<div class='form-group'>";
        html += "<label for='birthday' class='col-md-2 control-label'>Thời gian làm</label>";
        html += "<div class='col-md-1'>";
        html += "<label for='birthday' class='col-md-2 control-label'>Từ:</label>";
        html += "</div>";
        html += "<div class='col-md-2'>";
        html += "<select class='form-control col-md-2' class='thang_bat_dau' id='thang_bat_dau_lam_viec_" + count_kinh_nghiem + "'>";
        html += "<option value='0'>Chọn Tháng</option>";
        html += "<option value='1'>Tháng 1</option>";
        html += "<option value='2'>Tháng 2</option>";
        html += "<option value='3'>Tháng 3</option>";
        html += "<option value='4'>Tháng 4</option>";
        html += "<option value='5'>Tháng 5</option>";
        html += "<option value='6'>Tháng 6</option>";
        html += "<option value='7'>Tháng 7</option>";
        html += "<option value='8'>Tháng 8</option>";
        html += "<option value='9'>Tháng 9</option>";
        html += "<option value='10'>Tháng 10</option>";
        html += "<option value='11'>Tháng 11</option>";
        html += "<option value='12'>Tháng 12</option>";
        html += "</select>";
        html += "</div>";
        html += "<div class='col-md-2'>";
        html += "<select class='form-control col-md-2' class='nam_bat_dau' id='nam_bat_dau_lam_viec_" + count_kinh_nghiem + "'>";
        html += "<option value='0'>Chọn Năm</option>";
        html += "<option value='2017'>Năm 2017</option><option value='2016'>Năm 2016</option><option value='2015'>Năm 2015</option><option value='2014'>Năm 2014</option><option value='2013'>Năm 2013</option><option value='2012'>Năm 2012</option><option value='2011'>Năm 2011</option><option value='2010'>Năm 2010</option><option value='2009'>Năm 2009</option><option value='2008'>Năm 2008</option><option value='2007'>Năm 2007</option><option value='2006'>Năm 2006</option><option value='2005'>Năm 2005</option><option value='2004'>Năm 2004</option><option value='2003'>Năm 2003</option><option value='2002'>Năm 2002</option><option value='2001'>Năm 2001</option><option value='2000'>Năm 2000</option><option value='1999'>Năm 1999</option><option value='1998'>Năm 1998</option><option value='1997'>Năm 1997</option><option value='1996'>Năm 1996</option><option value='1995'>Năm 1995</option><option value='1994'>Năm 1994</option><option value='1993'>Năm 1993</option><option value='1992'>Năm 1992</option><option value='1991'>Năm 1991</option><option value='1990'>Năm 1990</option><option value='1989'>Năm 1989</option><option value='1988'>Năm 1988</option><option value='1987'>Năm 1987</option><option value='1986'>Năm 1986</option><option value='1985'>Năm 1985</option><option value='1984'>Năm 1984</option><option value='1983'>Năm 1983</option><option value='1982'>Năm 1982</option><option value='1981'>Năm 1981</option><option value='1980'>Năm 1980</option><option value='1979'>Năm 1979</option><option value='1978'>Năm 1978</option><option value='1977'>Năm 1977</option><option value='1976'>Năm 1976</option><option value='1975'>Năm 1975</option><option value='1974'>Năm 1974</option><option value='1973'>Năm 1973</option><option value='1972'>Năm 1972</option><option value='1971'>Năm 1971</option><option value='1970'>Năm 1970</option><option value='1969'>Năm 1969</option><option value='1968'>Năm 1968</option><option value='1967'>Năm 1967</option><option value='1966'>Năm 1966</option><option value='1965'>Năm 1965</option><option value='1964'>Năm 1964</option><option value='1963'>Năm 1963</option><option value='1962'>Năm 1962</option><option value='1961'>Năm 1961</option>";
        html += "</select>";
        html += "</div>";
        html += "<div class='col-md-1'>";
        html += "<label for='birthday' class='col-md-2 control-label'>Đến:</label>";
        html += "</div>";
        html += "<div class='col-md-2'>";
        html += "<select class='form-control col-md-2' class='thang_ket_thuc' id='thang_ket_thuc_lam_viec_" + count_kinh_nghiem + "'>";
        html += "<option value='0'>Chọn Tháng</option>";
        html += "<option value='1'>Tháng 1</option>";
        html += "<option value='2'>Tháng 2</option>";
        html += "<option value='3'>Tháng 3</option>";
        html += "<option value='4'>Tháng 4</option>";
        html += "<option value='5'>Tháng 5</option>";
        html += "<option value='6'>Tháng 6</option>";
        html += "<option value='7'>Tháng 7</option>";
        html += "<option value='8'>Tháng 8</option>";
        html += "<option value='9'>Tháng 9</option>";
        html += "<option value='10'>Tháng 10</option>";
        html += "<option value='11'>Tháng 11</option>";
        html += "<option value='12'>Tháng 12</option>";
        html += "</select>";
        html += "</div>";
        html += "<div class='col-md-2'>";
        html += "<select class='form-control col-md-2' class='nam_ket_thuc' id='nam_ket_thuc_lam_viec_" + count_kinh_nghiem + "'>";
        html += "<option value='0'>Chọn Năm</option>";
        html += "<option value='2017'>Năm 2017</option><option value='2016'>Năm 2016</option><option value='2015'>Năm 2015</option><option value='2014'>Năm 2014</option><option value='2013'>Năm 2013</option><option value='2012'>Năm 2012</option><option value='2011'>Năm 2011</option><option value='2010'>Năm 2010</option><option value='2009'>Năm 2009</option><option value='2008'>Năm 2008</option><option value='2007'>Năm 2007</option><option value='2006'>Năm 2006</option><option value='2005'>Năm 2005</option><option value='2004'>Năm 2004</option><option value='2003'>Năm 2003</option><option value='2002'>Năm 2002</option><option value='2001'>Năm 2001</option><option value='2000'>Năm 2000</option><option value='1999'>Năm 1999</option><option value='1998'>Năm 1998</option><option value='1997'>Năm 1997</option><option value='1996'>Năm 1996</option><option value='1995'>Năm 1995</option><option value='1994'>Năm 1994</option><option value='1993'>Năm 1993</option><option value='1992'>Năm 1992</option><option value='1991'>Năm 1991</option><option value='1990'>Năm 1990</option><option value='1989'>Năm 1989</option><option value='1988'>Năm 1988</option><option value='1987'>Năm 1987</option><option value='1986'>Năm 1986</option><option value='1985'>Năm 1985</option><option value='1984'>Năm 1984</option><option value='1983'>Năm 1983</option><option value='1982'>Năm 1982</option><option value='1981'>Năm 1981</option><option value='1980'>Năm 1980</option><option value='1979'>Năm 1979</option><option value='1978'>Năm 1978</option><option value='1977'>Năm 1977</option><option value='1976'>Năm 1976</option><option value='1975'>Năm 1975</option><option value='1974'>Năm 1974</option><option value='1973'>Năm 1973</option><option value='1972'>Năm 1972</option><option value='1971'>Năm 1971</option><option value='1970'>Năm 1970</option><option value='1969'>Năm 1969</option><option value='1968'>Năm 1968</option><option value='1967'>Năm 1967</option><option value='1966'>Năm 1966</option><option value='1965'>Năm 1965</option><option value='1964'>Năm 1964</option><option value='1963'>Năm 1963</option><option value='1962'>Năm 1962</option><option value='1961'>Năm 1961</option>";
        html += "</select>";
        html += "</div>";
        html += "</div>";
        // html += "<div class='form-group'>";
        // html += "<div class='col-md-12'>";
        // html += "<label for='ten_cong_ty' class='col-md-2 control-label'>Địa chỉ công ty</label>";
        // html += "<div class='col-md-4'>";
        // html += "<input type='text' class='form-control' class='dia_chi_cong_ty' id='dia_chi_cong_ty_" + count_kinh_nghiem + "'>";
        // html += "</div>";
        // html += "<div class='col-md-3'>";
        // html += "<select class='form-control thanh_pho' id='thanh_pho_" + count_kinh_nghiem + "'><option value='0'>Chọn Tỉnh / Thành Phố--</option><option value='1'>Hà Nội</option><option value='2'>Hồ Chí Minh</option><option value='3'>Đà Nẵng</option><option value='4'>Hải Phòng</option><option value='5'>Cần Thơ</option><option value='6'>An Giang</option><option value='7'>Bà Rịa Vũng Tàu</option><option value='8'>Bạc Liêu</option><option value='9'>Bắc Cạn</option><option value='10'>Bắc Giang</option><option value='11'>Hải Dương</option><option value='12'>Bắc Ninh</option><option value='13'>Bến Tre</option><option value='14'>Bình Dương</option><option value='15'>Bình Định</option><option value='16'>Bình Phước</option><option value='17'>Bình Thuận</option><option value='18'>Cà Mau</option><option value='19'>Cao Bằng</option><option value='20'>Đắk Lắk</option><option value='21'>Đăk Nông</option><option value='22'>Điện Biên</option><option value='23'>Đồng Nai</option><option value='24'>Đồng Tháp</option><option value='25'>Gia Lai</option><option value='26'>Hà Giang</option><option value='27'>Hà Nam</option><option value='28'>Hà Tĩnh</option><option value='29'>Hậu Giang</option><option value='30'>Hòa Bình</option><option value='31'>Hưng Yên</option><option value='32'>Khánh Hòa</option><option value='33'>Kiên Giang</option><option value='34'>Kon Tum</option><option value='35'>Lai Châu</option><option value='36'>Lâm Đồng</option><option value='37'>Lạng Sơn</option><option value='38'>Lào Cai</option><option value='39'>Long An</option><option value='40'>Nam Định</option><option value='41'>Nghệ An</option><option value='42'>Ninh Bình</option><option value='43'>Ninh Thuận</option><option value='44'>Phú Thọ</option><option value='45'>Phú Yên</option><option value='46'>Quảng Bình</option><option value='47'>Quảng Nam</option><option value='48'>Quảng Ngãi</option><option value='49'>Quảng Ninh</option><option value='50'>Quảng Trị</option><option value='51'>Sóc Trăng</option><option value='52'>Sơn La</option><option value='53'>Tây Ninh</option><option value='54'>Thái Bình</option><option value='55'>Thái Nguyên</option><option value='56'>Thanh Hóa</option><option value='57'>Huế</option><option value='58'>Tiền Giang</option><option value='59'>Trà Vinh</option><option value='60'>Tuyên Quang</option><option value='61'>Vĩnh Long</option><option value='62'>Vĩnh Phúc</option><option value='63'>Yên Bái</option></select>";
        // html += "</div>";
        // html += "<div class='col-md-3'>";
        // html += "<select class='form-control quan_huyen' id='quan_huyen_" + count_kinh_nghiem + "'><option value='0'>Chọn Quận / Huyện --</option></select>";
        // html += "</div>";
        // html += "</div>";
        // html += "</div>";
        html += "<div class='form-group'>";
        // html += "<div class='col-md-2 col-sm-offset-1 image_company'>";
        // html += "<img src='" + url_site + "/public/images/anh_cong_ty.jpg' id='company_image_" + count_kinh_nghiem + "' class='img-company' style='height: 92px; width:100%; background-color: #fff; border: 2px solid gray; border-radius: 5px;'>";
        // html += "<input type='file' class='company-img' id='company-img-" + count_kinh_nghiem + "' style='display: none;'>";
        // html += "</div>";
        html += "<label for='ten_cong_ty' class='col-md-2 control-label'>Mô tả công việc</label>";
        html += "<div class='col-md-10'>";
        html += "<textarea rows='4' cols='50' class='form-control' class='mo_ta_" + count_kinh_nghiem + "' id='mo_ta_" + count_kinh_nghiem + "' placeholder='Mô tả ngắn về công việc?'></textarea>";
        html += "</div>";
        html += "</div>";
        html += "</div>";
        html += "<div class='form-group'>";
        html += "<div class='col-md-8'>";
        html += "<p id='kinh_nghiem_" + count_kinh_nghiem + "_txt' class='kinh-nghiem-hide'></p>";
        html += "</div>";
        html += "<div class='col-md-4'>";
        html += "<div class='btn btn-danger pull-right kinh_nghiem_delete-btn' id='delete_kinh_nghiem_" + count_kinh_nghiem + "'>Hủy bỏ</div>";
        html += "<div class='btn btn-primary pull-right kinh_nghiem_edit-btn' id='edit_kinh_nghiem_" + count_kinh_nghiem + "' style='display:none;'>Chỉnh sửa</div>";
        html += "<div class='btn btn-primary pull-right kinh_nghiem_success-btn' id='success_kinh_nghiem_" + count_kinh_nghiem + "'>Hoàn thành</div>";
        html += "</div>";
        html += "</div>";
        html += "</div>";
        html += "</div>";
        $(html).appendTo('#kinh_nghiem_lam_viec>.panel-body');
        addEventToKinhNghiemLamViec();
    });
    $('.kinh_nghiem_delete-btn').click(function () {
        var id_obj = $(this).attr('id');
        id_obj = id_obj.substring(19, id_obj.length);
        $('#kinh_nghiem_lam_viec_' + id_obj).hide();
        $('#kinh_nghiem_lam_viec_' + id_obj).addClass('removed');
        count_kinh_nghiem;
    });
    $('.kinh_nghiem_success-btn').click(function () {
        var id_obj = $(this).attr('id');
        id_obj = id_obj.substring(20, id_obj.length);

        if (!validate_kinh_nghiem_cu(id_obj)) {
            return false;
        }

        renderJsonKinhNghiem(id_obj);
        
        $('#kinh_nghiem_lam_viec_' + id_obj + '_content').fadeOut("slow", function () {});
        $('#kinh_nghiem_' + id_obj + '_txt').html(' - ' + $('#vi_tri_' + id_obj).val() + ' tại ' + $('#ten_cong_ty_' + id_obj).val() + '  ( ' + $('#nam_bat_dau_lam_viec_' + id_obj).val() + ' - ' + $('#nam_ket_thuc_lam_viec_' + id_obj).val() + ' )');
        $(this).hide();
        $('#edit_kinh_nghiem_' + id_obj).show();
    });
    $('.kinh_nghiem_edit-btn').click(function () {
        var id_obj = $(this).attr('id');
        id_obj = id_obj.substring(17, id_obj.length);
        $('#kinh_nghiem_lam_viec_' + id_obj + '_content').show();
        $(this).hide();
        $('#success_kinh_nghiem_' + id_obj).show();
    });
    $(".thanh_pho").change(function () {
        cityId = $(this).attr('id');
        cityId = cityId.substring(10, cityId.length);
        var citId = $(this).val();
        var request = $.ajax({
            url: url_site + "/getDistrict/" + citId,
            method: "GET",
            dataType: "html"
        });
        request.done(function (msg) {
            $("#quan_huyen_" + cityId).html(msg);
        });
        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    });
    function addEventToKinhNghiemLamViec() {
        $('.kinh_nghiem_delete-btn').off('click');
        $('.kinh_nghiem_delete-btn').click(function () {
            var id_obj = $(this).attr('id');
            id_obj = id_obj.substring(19, id_obj.length);
            $('#kinh_nghiem_lam_viec_' + id_obj).hide();
            $('#kinh_nghiem_lam_viec_' + id_obj).addClass('removed');
            count_kinh_nghiem;
        });
        $('.kinh_nghiem_success-btn').off('click');
        $('.kinh_nghiem_success-btn').click(function () {
            var id_obj = $(this).attr('id');
            id_obj = id_obj.substring(20, id_obj.length);

            if (!validate_kinh_nghiem_cu(id_obj)) {
                return false;
            }

            renderJsonKinhNghiem(id_obj);
            $('#kinh_nghiem_lam_viec_' + id_obj + '_content').fadeOut("slow", function () {});
            $('#kinh_nghiem_' + id_obj + '_txt').html(' - ' + $('#vi_tri_' + id_obj).val() + ' tại ' + $('#ten_cong_ty_' + id_obj).val() + '  ( ' + $('#nam_bat_dau_lam_viec_' + id_obj).val() + ' - ' + $('#nam_ket_thuc_lam_viec_' + id_obj).val() + ' )');
            $(this).hide();
            $('#edit_kinh_nghiem_' + id_obj).show();
        });
        $('.kinh_nghiem_edit-btn').off('click');
        $('.kinh_nghiem_edit-btn').click(function () {
            var id_obj = $(this).attr('id');
            id_obj = id_obj.substring(17, id_obj.length);
            $('#kinh_nghiem_lam_viec_' + id_obj + '_content').show();
            $(this).hide();
            $('#success_kinh_nghiem_' + id_obj).show();
        });
        $('.thanh_pho').off('change');
        $(".thanh_pho").change(function () {
            cityId = $(this).attr('id');
            cityId = cityId.substring(10, cityId.length);
            var citId = $(this).val();
            var request = $.ajax({
                url: url_site + "/getDistrict/" + citId,
                method: "GET",
                dataType: "html"
            });
            request.done(function (msg) {
                $("#quan_huyen_" + cityId).html(msg);
            });
            request.fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });
        });
        
        $('.img-company').off('click');
        $('.img-company').on('click', function (e) {
            var id_obj = $(this).attr('id');
            console.log(id_obj);
            id_obj = id_obj.substring(14, id_obj.length);
            $('#company-img-' + id_obj).click();
        });
        
        $('.company-img').off('change');
        $('.company-img').on('change', function (e) {
            var fileInput = this;
            var id_obj = $(this).attr('id');
            id_obj = id_obj.substring(12, id_obj.length);
            if (fileInput.files[0]) {
                var data = new FormData();
                data.append('input_file_name', fileInput.files[0]);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    processData: false, // important
                    contentType: false, // important
                    data: data,
                    url: url_site + "/postImage",
                    dataType: 'json',
                    success: function (jsonData) {
                        if (jsonData.code == 200) {
                            $('#company_image_' + id_obj).attr('src', 'http://test.gmon.com.vn/?image=' + jsonData.image_url);
                            $('#lam_viec_' + id_obj + '_image').val(jsonData.image_url);
                        }
                    }
                });
            }
        });
    }

    function validate_hoc_tap_cu(id) {
        if ($('#truong_hoc_' + id).val().length <= 0) {
            swal("Nơi học không được để trống!", "Xin hãy điền Nơi học!");
            return false;
        }

        if ($("input[name='bang_cap_" + id + "']:checked").val() == 0) {
            if ($("input[name='student_process_" + id + "']:checked").val() == 1) {
                // hoc xong
                if (parseInt($('#nam_bat_dau_' + id).val()) == parseInt($('#nam_ket_thuc_' + id).val())) {
                    if (parseInt($('#thang_bat_dau_' + id).val()) > parseInt($('#thang_ket_thuc_' + id).val())) {
                        swal("Tháng bắt đầu lớn hơn Tháng kết thúc!", "Xin hãy chọn lại Tháng bắt đầu và Tháng kết thúc!");
                        return false;
                    }
                }
                
                if ($('#thang_ket_thuc_' + id).val() <= 0) {
                    swal("Tháng kết thúc học tập không được bỏ trống!", "Xin hãy chọn Tháng kết thúc học tập!");
                    return false;
                }

                if (parseInt($('#nam_bat_dau_' + id).val()) > parseInt($('#nam_ket_thuc_' + id).val())) {
                    swal("Năm bắt đầu lớn hơn Năm kết thúc!", "Xin hãy chọn lại Năm bắt đầu và Năm kết thúc!");
                    return false;
                }
                
                if ($('#nam_ket_thuc_' + id).val() <= 0) {
                    swal("Năm kết thúc học tập không được bỏ trống!", "Xin hãy chọn Năm kết thúc học tập!");
                    return false;
                }
            }
            
            if ($('#nam_bat_dau_' + id).val() <= 0) {
                swal("Năm bắt đầu học tập không được bỏ trống!", "Xin hãy chọn Năm bắt đầu học tập!");
                return false;
            }

            if ($('#thang_bat_dau_' + id).val() <= 0) {
                swal("Tháng bắt đầu học tập không được bỏ trống!", "Xin hãy chọn Tháng bắt đầu học tập!");
                return false;
            }
        }

        if ($("input[name='bang_cap_" + id + "']:checked").val() == 1) {
            if ($("input[name='student_process_" + id + "']:checked").val() == 1) {
                // hoc xong
                if (parseInt($('#nam_bat_dau_' + id).val()) == parseInt($('#nam_ket_thuc_' + id).val())) {
                    if (parseInt($('#thang_bat_dau_' + id).val()) > parseInt($('#thang_ket_thuc_' + id).val())) {
                        swal("Tháng bắt đầu lớn hơn Tháng kết thúc!", "Xin hãy chọn lại Tháng bắt đầu và Tháng kết thúc!");
                        return false;
                    }
                }
                
                if ($('#thang_ket_thuc_' + id).val() <= 0) {
                    swal("Tháng kết thúc học tập không được bỏ trống!", "Xin hãy chọn Tháng kết thúc học tập!");
                    return false;
                }

                if (parseInt($('#nam_bat_dau_' + id).val()) > parseInt($('#nam_ket_thuc_' + id).val())) {
                    swal("Năm bắt đầu lớn hơn Năm kết thúc!", "Xin hãy chọn lại Năm bắt đầu và Năm kết thúc!");
                    return false;
                }
                
                if ($('#nam_ket_thuc_' + id).val() <= 0) {
                    swal("Năm kết thúc học tập không được bỏ trống!", "Xin hãy chọn Năm kết thúc học tập!");
                    return false;
                }
            }
            
            if ($('#nam_bat_dau_' + id).val() <= 0) {
                swal("Năm bắt đầu học tập không được bỏ trống!", "Xin hãy chọn Năm bắt đầu học tập!");
                return false;
            }

            if ($('#thang_bat_dau_' + id).val() <= 0) {
                swal("Tháng bắt đầu học tập không được bỏ trống!", "Xin hãy chọn Tháng bắt đầu học tập!");
                return false;
            }

            if ($('#chuyen_nganh_' + id).val().length <= 1) {
                if ($("input[name='bang_cap_" + id + "']:checked").val() == 1 || $("input[name='bang_cap_" + id + "']:checked").val() == 0) {
                    swal("Bạn chưa điền Chuyên ngành!", "Xin hãy điền Chuyên ngành!");
                    return false;
                }
            }
        }

        if ($("input[name='bang_cap_" + id + "']:checked").val() == 2) {
            if ($("input[name='student_process_" + id + "']:checked").val() == 1) {
                // hoc xong
                if (parseInt($('#nam_bat_dau_' + id).val()) == parseInt($('#nam_ket_thuc_' + id).val())) {
                    if (parseInt($('#thang_bat_dau_' + id).val()) > parseInt($('#thang_ket_thuc_' + id).val())) {
                        swal("Tháng bắt đầu lớn hơn Tháng kết thúc!", "Xin hãy chọn lại Tháng bắt đầu và Tháng kết thúc!");
                        return false;
                    }
                }

                if (parseInt($('#nam_bat_dau_' + id).val()) > parseInt($('#nam_ket_thuc_' + id).val())) {
                    swal("Năm bắt đầu lớn hơn Năm kết thúc!", "Xin hãy chọn lại Năm bắt đầu và Năm kết thúc!");
                    return false;
                }
                
                if ($('#nam_ket_thuc_' + id).val() <= 0) {
                    swal("Năm kết thúc học tập không được bỏ trống!", "Xin hãy chọn Năm kết thúc học tập!");
                    return false;
                }
            }
            
            if ($('#nam_bat_dau_' + id).val() <= 0) {
                swal("Năm bắt đầu học tập không được bỏ trống!", "Xin hãy chọn Năm bắt đầu học tập!");
                return false;
            }
        }

        return true;
    }

    $('#them_moi_hoc_tap').click(function () {
        if (!validate_hoc_tap_cu(count_hoc_tap)) {
            swal("Quá trình học tập trước chưa được hoàn thành!", "Xin hãy hoàn thành Quá trình học tập trước để có thể thêm mới!");
            return false;
        }
        count_hoc_tap++;
        var html = "";
        html += "<div class='form-hoc-tap-group' id='hoc_tap_" + count_hoc_tap + "'>";
        html += "<input type='hidden' class='education_json'  id='hoc_tap_" + count_hoc_tap + "_json' value=''>";
        html += "<div id='hoc_tap_" + count_hoc_tap + "_content'>";
        html += "<div class='form-group'>";
        html += "<div class='col-md-12'>";
        html += "<label class='col-md-2'><input type='radio' class='bang_cap' name='bang_cap_" + count_hoc_tap + "' value='0' checked> Chứng chỉ</label>";
        html += "<label class='col-md-5'><input type='radio' class='bang_cap' name='bang_cap_" + count_hoc_tap + "' value='1'>Sau Đại học / Đại học / Cao đẳng / Trung cấp</label>";
        html += "<label class='col-md-5'><input type='radio' class='bang_cap' name='bang_cap_" + count_hoc_tap + "' value='2'>Tiểu học / Trung học</label>";
        html += "</div>";
        html += "</div>";
        html += "<div class='form-group'>";
        html += "<label for='birthday' class='col-md-2 control-label'>Học tại</label>";
        html += "<div class='col-md-4'>";
        html += "<input type='text' class='form-control' class='truong_hoc' id='truong_hoc_" + count_hoc_tap + "' placeholder='Nhập tên trường, trung tâm học'>";
        html += "</div>";
        html += "<div class='col-md-6'>";
        html += "<label class='col-sm-offset-2'><input type='radio' class='student_process' name='student_process_" + count_hoc_tap + "' value='0' checked>Đang học</label>";
        html += "<label class='col-sm-offset-2'><input type='radio' class='student_process' name='student_process_" + count_hoc_tap + "' value='1'>Đã tốt nghiệp</label>";
        html += "</div>";
        html += "</div>";
        html += "<div class='form-group'>";
        html += "<label for='birthday' class='col-md-2 control-label'>Thời gian học</label>";
        html += "<div class='col-md-1'>";
        html += "<label for='birthday' class='col-md-2 control-label'>Từ:</label>";
        html += "</div>";
        html += "<div class='col-md-2'>";
        html += "<select class='form-control col-md-2' class='thang_bat_dau' id='thang_bat_dau_" + count_hoc_tap + "'>";
        html += "<option value='0'>Chọn Tháng</option>";
        html += "<option value='1'>Tháng 1</option>";
        html += "<option value='2'>Tháng 2</option>";
        html += "<option value='3'>Tháng 3</option>";
        html += "<option value='4'>Tháng 4</option>";
        html += "<option value='5'>Tháng 5</option>";
        html += "<option value='6'>Tháng 6</option>";
        html += "<option value='7'>Tháng 7</option>";
        html += "<option value='8'>Tháng 8</option>";
        html += "<option value='9'>Tháng 9</option>";
        html += "<option value='10'>Tháng 10</option>";
        html += "<option value='11'>Tháng 11</option>";
        html += "<option value='12'>Tháng 12</option>";
        html += "</select>";
        html += "</div>";
        html += "<div class='col-md-2'>";
        html += "<select class='form-control col-md-2' class='nam_bat_dau' id='nam_bat_dau_" + count_hoc_tap + "'>";
        html += "<option value='0'>Chọn Năm</option>";
        html += "<option value='2017'>Năm 2017</option><option value='2016'>Năm 2016</option><option value='2015'>Năm 2015</option><option value='2014'>Năm 2014</option><option value='2013'>Năm 2013</option><option value='2012'>Năm 2012</option><option value='2011'>Năm 2011</option><option value='2010'>Năm 2010</option><option value='2009'>Năm 2009</option><option value='2008'>Năm 2008</option><option value='2007'>Năm 2007</option><option value='2006'>Năm 2006</option><option value='2005'>Năm 2005</option><option value='2004'>Năm 2004</option><option value='2003'>Năm 2003</option><option value='2002'>Năm 2002</option><option value='2001'>Năm 2001</option><option value='2000'>Năm 2000</option><option value='1999'>Năm 1999</option><option value='1998'>Năm 1998</option><option value='1997'>Năm 1997</option><option value='1996'>Năm 1996</option><option value='1995'>Năm 1995</option><option value='1994'>Năm 1994</option><option value='1993'>Năm 1993</option><option value='1992'>Năm 1992</option><option value='1991'>Năm 1991</option><option value='1990'>Năm 1990</option><option value='1989'>Năm 1989</option><option value='1988'>Năm 1988</option><option value='1987'>Năm 1987</option><option value='1986'>Năm 1986</option><option value='1985'>Năm 1985</option><option value='1984'>Năm 1984</option><option value='1983'>Năm 1983</option><option value='1982'>Năm 1982</option><option value='1981'>Năm 1981</option><option value='1980'>Năm 1980</option><option value='1979'>Năm 1979</option><option value='1978'>Năm 1978</option><option value='1977'>Năm 1977</option><option value='1976'>Năm 1976</option><option value='1975'>Năm 1975</option><option value='1974'>Năm 1974</option><option value='1973'>Năm 1973</option><option value='1972'>Năm 1972</option><option value='1971'>Năm 1971</option><option value='1970'>Năm 1970</option><option value='1969'>Năm 1969</option><option value='1968'>Năm 1968</option><option value='1967'>Năm 1967</option><option value='1966'>Năm 1966</option><option value='1965'>Năm 1965</option><option value='1964'>Năm 1964</option><option value='1963'>Năm 1963</option><option value='1962'>Năm 1962</option><option value='1961'>Năm 1961</option>";
        html += "</select>";
        html += "</div>";
        html += "<div class='col-md-1 learn-to-" + count_hoc_tap + "' style='display:none;'>";
        html += "<label for='birthday' class='col-md-2 control-label'>Đến:</label>";
        html += "</div>";
        html += "<div class='col-md-2 learn-to-" + count_hoc_tap + "' style='display:none;'>";
        html += "<select class='form-control col-md-2' class='thang_ket_thuc' id='thang_ket_thuc_" + count_hoc_tap + "'>";
        html += "<option value='0'>Chọn Tháng</option>";
        html += "<option value='1'>Tháng 1</option>";
        html += "<option value='2'>Tháng 2</option>";
        html += "<option value='3'>Tháng 3</option>";
        html += "<option value='4'>Tháng 4</option>";
        html += "<option value='5'>Tháng 5</option>";
        html += "<option value='6'>Tháng 6</option>";
        html += "<option value='7'>Tháng 7</option>";
        html += "<option value='8'>Tháng 8</option>";
        html += "<option value='9'>Tháng 9</option>";
        html += "<option value='10'>Tháng 10</option>";
        html += "<option value='11'>Tháng 11</option>";
        html += "<option value='12'>Tháng 12</option>";
        html += "</select>";
        html += "</div>";
        html += "<div class='col-md-2 learn-to-" + count_hoc_tap + "' style='display:none;'>";
        html += "<select class='form-control col-md-2' class='nam_ket_thuc' id='nam_ket_thuc_" + count_hoc_tap + "'>";
        html += "<option value='0'>Chọn Năm</option>";
        html += "<option value='2017'>Năm 2017</option><option value='2016'>Năm 2016</option><option value='2015'>Năm 2015</option><option value='2014'>Năm 2014</option><option value='2013'>Năm 2013</option><option value='2012'>Năm 2012</option><option value='2011'>Năm 2011</option><option value='2010'>Năm 2010</option><option value='2009'>Năm 2009</option><option value='2008'>Năm 2008</option><option value='2007'>Năm 2007</option><option value='2006'>Năm 2006</option><option value='2005'>Năm 2005</option><option value='2004'>Năm 2004</option><option value='2003'>Năm 2003</option><option value='2002'>Năm 2002</option><option value='2001'>Năm 2001</option><option value='2000'>Năm 2000</option><option value='1999'>Năm 1999</option><option value='1998'>Năm 1998</option><option value='1997'>Năm 1997</option><option value='1996'>Năm 1996</option><option value='1995'>Năm 1995</option><option value='1994'>Năm 1994</option><option value='1993'>Năm 1993</option><option value='1992'>Năm 1992</option><option value='1991'>Năm 1991</option><option value='1990'>Năm 1990</option><option value='1989'>Năm 1989</option><option value='1988'>Năm 1988</option><option value='1987'>Năm 1987</option><option value='1986'>Năm 1986</option><option value='1985'>Năm 1985</option><option value='1984'>Năm 1984</option><option value='1983'>Năm 1983</option><option value='1982'>Năm 1982</option><option value='1981'>Năm 1981</option><option value='1980'>Năm 1980</option><option value='1979'>Năm 1979</option><option value='1978'>Năm 1978</option><option value='1977'>Năm 1977</option><option value='1976'>Năm 1976</option><option value='1975'>Năm 1975</option><option value='1974'>Năm 1974</option><option value='1973'>Năm 1973</option><option value='1972'>Năm 1972</option><option value='1971'>Năm 1971</option><option value='1970'>Năm 1970</option><option value='1969'>Năm 1969</option><option value='1968'>Năm 1968</option><option value='1967'>Năm 1967</option><option value='1966'>Năm 1966</option><option value='1965'>Năm 1965</option><option value='1964'>Năm 1964</option><option value='1963'>Năm 1963</option><option value='1962'>Năm 1962</option><option value='1961'>Năm 1961</option>";
        html += "</select>";
        html += "</div>";
        html += "</div>";
        html += "<div class='form-group'>";
        html += "<label for='chuyen_nganh' class='col-md-2 control-label'><div id='chuyen_nganh_" + count_hoc_tap + "_label'>Chuyên ngành</div></label>";
        html += "<div class='col-md-5'>";
        html += "<input type='text' class='form-control' class='chuyen_nganh' id='chuyen_nganh_" + count_hoc_tap + "'>";
        html += "</div>";
        html += "<label for='birthday' class='col-md-2 control-label'><span  id='loai_tot_nghiep_" + count_hoc_tap + "_label' style='display:none;'>Tốt nghiệp loại</span></label>";
        html += "<div class='col-md-3'>";
        html += "<select class='form-control' class='loai_tot_nghiep' id='loai_tot_nghiep_" + count_hoc_tap + "' style='display:none;'>";
        html += "<option value='0'>Chọn loại tốt nghiệp</option>";
        html += "<option value='1'>Xuất sắc</option>";
        html += "<option value='2'>Giỏi</option>";
        html += "<option value='3'>Khá</option>";
        html += "<option value='4'>Trung bình khá</option>";
        html += "<option value='5'>Trung bình</option>";
        html += "</select>";
        html += "</div>";
        html += "</div>";
        html += "</div>";
        html += "<div class='form-group'>";
        html += "<div class='col-md-8'>";
        html += "<p id='truong_hoc_" + count_hoc_tap + "_txt' class='truong-hoc-hide'></p>";
        html += "</div>";
        html += "<div class='col-md-4'>";
        html += "<div class='btn btn-danger pull-right hoc_tap_delete-btn' id='delete_" + count_hoc_tap + "'>Hủy bỏ</div>";
        html += "<div class='btn btn-primary pull-right hoc_tap_success-btn' id='success_" + count_hoc_tap + "'>Hoàn thành</div>";
        html += "<div class='btn btn-primary pull-right hoc_tap_edit-btn' id='edit_" + count_hoc_tap + "' style='display:none;'>Chỉnh sửa</div>";
        html += "</div>";
        html += "</div>";
        html += "</div>";
        $(html).appendTo('#qua_trinh_hoc_tap>.panel-body');
        addEventToQuaTrinhHocTap();
    });
    $('.hoc_tap_delete-btn').click(function () {
        var id_obj = $(this).attr('id');
        id_obj = id_obj.substring(7, id_obj.length);
        $('#hoc_tap_' + id_obj).hide();
        $('#hoc_tap_' + id_obj).addClass('removed');
        count_hoc_tap;
    });
    $('.student_process').click(function () {
        var id_obj = $(this).attr('name');
        id_obj = id_obj.substring(16, id_obj.length);
        if ($(this).val() == 1) {
            $('#loai_tot_nghiep_' + id_obj + '_label').show();
            $('#loai_tot_nghiep_' + id_obj).show();
            $('.learn-to-' + id_obj).show();
        } else {
            $('#loai_tot_nghiep_' + id_obj + '_label').hide();
            $('#loai_tot_nghiep_' + id_obj).hide();
            $('.learn-to-' + id_obj).hide();
        }
    });
    $('.hoc_tap_success-btn').click(function () {
        var id_obj = $(this).attr('id');
            id_obj = id_obj.substring(8, id_obj.length);

        if (!validate_hoc_tap_cu(id_obj)) {
            return false;
        }

        renderJsonHocTap(id_obj);
        $('#hoc_tap_' + id_obj + '_content').fadeOut("slow", function () {});
        if ($("input[name='student_process_" + count_hoc_tap + "']:checked").val() == 1) {
            $('#truong_hoc_' + id_obj + '_txt').html(' - ' + $('#truong_hoc_' + id_obj).val() + ' ( ' + $('#nam_bat_dau_' + id_obj).val() + ' - ' + $('#nam_ket_thuc_' + id_obj).val() + ' )');
        }else{
            $('#truong_hoc_' + id_obj + '_txt').html(' - ' + $('#truong_hoc_' + id_obj).val() + ' ( ' + $('#nam_bat_dau_' + id_obj).val() + ' - Nay )');
        }
        $(this).hide();
        $('#edit_' + id_obj).show();
    });
    $('.hoc_tap_edit-btn').click(function () {
        var id_obj = $(this).attr('id');
        id_obj = id_obj.substring(5, id_obj.length);
        $('#hoc_tap_' + id_obj + '_content').show();
        $(this).hide();
        $('#success_' + id_obj).show();
    });
    $('.bang_cap').change(function () {
        var id_obj = $(this).attr('name');
        id_obj = id_obj.substring(9, id_obj.length);
        switch (this.value) {
            case '0':
                $('#chuyen_nganh_0_label').show();
                $('#chuyen_nganh_0').show();
                break;
            case '1':
                $('#chuyen_nganh_0_label').show();
                $('#chuyen_nganh_0').show();
                break;
            case '2':
                $('#chuyen_nganh_0_label').hide();
                $('#chuyen_nganh_0').hide();
                break;
            default:
                $('#chuyen_nganh_0_label').show();
                $('#chuyen_nganh_0').show();
                break;
        }
    });
    function addEventToQuaTrinhHocTap() {
        $('.hoc_tap_delete-btn').click(function () {
            var id_obj = $(this).attr('id');
            id_obj = id_obj.substring(7, id_obj.length);
            $('#hoc_tap_' + id_obj).hide();
            $('#hoc_tap_' + id_obj).addClass('removed');
            count_hoc_tap;
        });
        $('.hoc_tap_success-btn').click(function () {

            var id_obj = $(this).attr('id');
            id_obj = id_obj.substring(8, id_obj.length);

            if (!validate_hoc_tap_cu(id_obj)) {
                return false;
            }

            renderJsonHocTap(id_obj);
            $('#hoc_tap_' + id_obj + '_content').fadeOut("slow", function () {});
            if ($("input[name='student_process_" + count_hoc_tap + "']:checked").val() == 1) {
                $('#truong_hoc_' + id_obj + '_txt').html(' - ' + $('#truong_hoc_' + id_obj).val() + ' ( ' + $('#nam_bat_dau_' + id_obj).val() + ' - ' + $('#nam_ket_thuc_' + id_obj).val() + ' )');
            }else{
                $('#truong_hoc_' + id_obj + '_txt').html(' - ' + $('#truong_hoc_' + id_obj).val() + ' ( ' + $('#nam_bat_dau_' + id_obj).val() + ' - Nay )');
            }
            $(this).hide();
            $('#edit_' + id_obj).show();
        });
        $('.student_process').click(function () {
            var id_obj = $(this).attr('name');
            id_obj = id_obj.substring(16, id_obj.length);
            if ($(this).val() == 1) {
                $('#loai_tot_nghiep_' + id_obj + '_label').show();
                $('#loai_tot_nghiep_' + id_obj).show();
                $('.learn-to-' + id_obj).show();
            } else {
                $('#loai_tot_nghiep_' + id_obj + '_label').hide();
                $('#loai_tot_nghiep_' + id_obj).hide();
                $('.learn-to-' + id_obj).hide();
            }
        });
        $('.hoc_tap_edit-btn').click(function () {
            var id_obj = $(this).attr('id');
            id_obj = id_obj.substring(5, id_obj.length);
            $('#hoc_tap_' + id_obj + '_content').show();
            $(this).hide();
            $('#success_' + id_obj).show();
        });
        $('.bang_cap').off('change');
        $('.bang_cap').change(function () {
            var id_obj = $(this).attr('name');
            id_obj = id_obj.substring(9, id_obj.length);
            switch (this.value) {
                case '0':
                    $('#chuyen_nganh_' + id_obj + '_label').show();
                    $('#chuyen_nganh_' + id_obj + '').show();
                    break;
                case '1':
                    $('#chuyen_nganh_' + id_obj + '_label').show();
                    $('#chuyen_nganh_' + id_obj + '').show();
                    break;
                case '2':
                    $('#chuyen_nganh_' + id_obj + '_label').hide();
                    $('#chuyen_nganh_' + id_obj + '').hide();
                    break;
                default:
                    $('#chuyen_nganh_' + id_obj + '_label').show();
                    $('#chuyen_nganh_' + id_obj + '').show();
                    break;
            }
        });
    }

    $('#datetimepicker').datetimepicker({
        format: 'DD/MM/YYYY',
        maxDate : '2012/01/01',
        minDate : '1970/01/01'
    });
    $('.img-company').on('click', function (e) {
        var id_obj = $(this).attr('id');
        id_obj = id_obj.substring(14, id_obj.length);
        $('#company-img-' + id_obj).click();
    });

    $('.company-img').on('change', function (e) {
        var fileInput = this;
        var id_obj = $(this).attr('id');
        id_obj = id_obj.substring(12, id_obj.length);
        if (fileInput.files[0]) {
            var data = new FormData();
            data.append('input_file_name', fileInput.files[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                processData: false, // important
                contentType: false, // important
                data: data,
                url: url_site + "/postImage",
                dataType: 'json',
                success: function (jsonData) {
                    if (jsonData.code == 200) {
                        $('#company_image_' + id_obj).attr('src', 'http://test.gmon.com.vn/?image=' + jsonData.image_url);
                        $('#lam_viec_' + id_obj + '_image').val(jsonData.image_url);
                    }
                }
            });
        }
    });
    $('#avatar-image').on('click', function (e) {
        // $('#avatar-img').click();
        $('.modal-show-avatar').modal('show');
    });
    $('#images').on('click', function (e) {
        $('#images-img').click();
    });
    $('#images-img').on('change', function (e) {
        var fileInput = this;
        var i = 0;
        $(fileInput.files).each(function (index) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var html = '<img src="' + e.target.result + '" class="img">';
                $('#images-plus').append(html);
            }
            
            reader.readAsDataURL(fileInput.files[i]);
            i++;
        });
    });
    
    $("#city").change(function () {
        var citId = $("#city").val();
        var request = $.ajax({
            url: url_site + "/getDistrict/" + citId,
            method: "GET",
            dataType: "html"
        });
        request.done(function (msg) {
            $("#district").html(msg);
        });
        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    });
    $("#district").change(function () {
        var districtId = $("#district").val();
        var request = $.ajax({
            url: url_site + "/getTown/" + districtId,
            method: "GET",
            dataType: "html"
        });
        request.done(function (msg) {
            $("#town").html(msg);
        });
        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    });

    function validateForm() {
        if ($('#birthday').val() == '') {
            swal("Ngày sinh bị bỏ trống!", "Xin hãy điền ngày sinh của bạn!");
            return false;
        }

        if ($('#city').val() == '0') {
            swal("Thành phố chưa được chọn!", "Xin hãy chọn Thành phố nơi bạn đang sinh sống!");
            return false;
        }

        if ($('#district').val() == '0') {
            swal("Quận / Huyện chưa được chọn!", "Xin hãy chọn Quận / Huyện nơi bạn đang sinh sống!");
            return false;
        }

        if ($('#town').val() == '0') {
            swal("Phường / Xã chưa được chọn!", "Xin hãy chọn Phường / Xã nơi bạn đang sinh sống!");
            return false;
        }

        if ($('#address').val().length == 0) {
            swal("Địa chỉ bị bỏ trống!", "Xin hãy điền địa chỉ nơi bạn đang sinh sống!");
            return false;
        }

        if ($('#avatar-image').attr('src') == (url_site + '/images/anh_dai_dien.jpg')) {
            swal("Ảnh đại diện chưa được upload!", "Xin hãy chọn 1 ảnh của bạn làm ảnh đại diện!");
            return false;
        }
        return true;
    }

    $("#submit-btn").click(function () {

        $('#education').val('');
        $('#word_experience').val('');

        $('#active').val(CKEDITOR.instances['active'].getData());
        $('#references').val(CKEDITOR.instances['references'].getData());
        $('#career_objective').val(CKEDITOR.instances['career_objective'].getData());
        $('#interests').val(CKEDITOR.instances['interests'].getData());

        $.each($(".form-hoc-tap-group"), function(){            
            if(!$(this).hasClass('removed')){
                $('#education').val($('#education').val() + ';' + $(this).find(".education_json").val());
            }
        });

        $.each($(".form-kinh-nghiem-group"), function(){            
            if(!$(this).hasClass('removed')){
                $('#word_experience').val($('#word_experience').val() + ';' + $(this).find(".word_experience_json").val());
            }
        });

        var listJobs = '';
        $('#jobs_hold .dropdown-menu.inner li.selected').each(function (index) {
            listJobs += $(this).text() + ';';
        });
        $('#jobs').val(listJobs);

        var listTimes = '';
        $('#time_can_work_hold .dropdown-menu.inner li.selected').each(function (index) {
            listTimes += $(this).text() + ';';
        });
        $('#time_can_work').val(listTimes);

        $('#salary').val($('#salary_select').val());

        if (!validateForm()) {
            return false;
        }

        if ($('.truong_hoc_' + count_hoc_tap).val().length > 0) {
            $('#success_' + count_hoc_tap).click();
        }

        if ($('.ten_cong_ty_' + count_kinh_nghiem).val().length > 0) {
            $('#success_kinh_nghiem_' + count_kinh_nghiem).click();
        }

        if ($('#ten_ngoai_ngu').val().length > 0) {
            $('#add-language').click();
        }

        if ($('#ten_ky_nang').val().length > 0) {
            $('#add-qualification').click();
        }

        return false;

        $("#create-curriculum-vitae").submit();
    });

    function renderJsonHocTap(id){
        var bang_cap = $("input[name='bang_cap_"+id+"']:checked"). val();
        var student_process = $("input[name='student_process_"+id+"']:checked"). val();
        var ret_arr = {};
        ret_arr['bang_cap'] = bang_cap;
        ret_arr['truong_hoc'] = $("#truong_hoc_"+id). val();
        ret_arr['student_process'] = student_process;
        ret_arr['thang_bat_dau'] = $('#thang_bat_dau_'+id).val();
        ret_arr['nam_bat_dau'] = $('#nam_bat_dau_'+id).val();
        ret_arr['thang_ket_thuc'] = $('#thang_ket_thuc_'+id).val();
        ret_arr['nam_ket_thuc'] = $('#nam_ket_thuc_'+id).val();
        if(bang_cap != 2){
            ret_arr['chuyen_nganh'] = $('#chuyen_nganh_'+id).val();
        }
        if(student_process!=0){
            ret_arr['loai_tot_nghiep'] = $('#loai_tot_nghiep_'+id + ' option:selected').text();
        }
        $('#hoc_tap_' + id + '_json').val(JSON.stringify(ret_arr));
    };
    function renderJsonKinhNghiem(id){
        var ret_arr = {};
        ret_arr['ten_cong_ty'] = $('#ten_cong_ty_'+id).val();
        ret_arr['vi_tri'] = $('#vi_tri_'+id).val();
        ret_arr['thang_bat_dau_lam_viec'] = $('#thang_bat_dau_lam_viec_'+id).val();
        ret_arr['nam_bat_dau_lam_viec'] = $('#nam_bat_dau_lam_viec_'+id).val();
        ret_arr['thang_ket_thuc_lam_viec'] = $('#thang_ket_thuc_lam_viec_'+id).val();
        ret_arr['nam_ket_thuc_lam_viec'] = $('#nam_ket_thuc_lam_viec_'+id).val();
        ret_arr['mo_ta'] = $('#mo_ta_'+id).val();
        $('#kinh_nghiem_lam_viec_' + id + '_json').val(JSON.stringify(ret_arr));
    };
    function renderJsonNgoaiNgu(){
        var ret_arr = {};
        ret_arr['ten_ngoai_ngu'] = $('#ten_ngoai_ngu').val();
        ret_arr['trinh_do_ngoai_ngu'] = $('#trinh_do_ngoai_ngu').val();
        $('#language').val($('#language').val() + ';' + JSON.stringify(ret_arr));
    };
    function renderJsonKyNang(){
        var ret_arr = {};
        ret_arr['ten_ky_nang'] = $('#ten_ky_nang').val();
        $('#qualification').val($('#qualification').val() + ';' + JSON.stringify(ret_arr));
    };

    function re_render_qualification(id){
        var json_string = $('#qualification').val();
        $('#qualification').val('');
        json_string = json_string.substring(1, json_string.length);
        json_array = json_string.split(";");
        $('#qualification_content').html('');
        var j=0;
        for(var i = 0; i < json_array.length; i++){
            if(i+1 == id){
                
            }else{
                var obj = $.parseJSON(json_array[i]);
                var html = ren_ky_nang(j+1, obj.ten_ky_nang);
                $('#qualification_content').append(html);
                $('#qualification').val($('#qualification').val() + ';' + json_array[i]);
                j++;
            }
        }
        $('.qualification-delete').off('click');
        $('.qualification-delete').click(function () {
            var id_obj = $(this).attr('id');
            id_obj = id_obj.substring(21, id_obj.length);
            $('#qualification-' + id_obj).remove();
            re_render_qualification(id_obj);
            count_qualification--;
        });
    }

    function re_render_language(id){
        var json_string = $('#language').val();
        $('#language').val('');
        json_string = json_string.substring(1, json_string.length);
        json_array = json_string.split(";");
        $('#ngoai_ngu_content').html('');
        var j=0;
        for(var i = 0; i < json_array.length; i++){
            if(i+1 == id){
                
            }else{
                var obj = $.parseJSON(json_array[i]);
                var html = ren_ngoai_ngu(j+1, obj.ten_ngoai_ngu, obj.trinh_do_ngoai_ngu);
                // update content
                $('#ngoai_ngu_content').append(html);
                // update json 
                $('#language').val($('#language').val() + ';' + json_array[i]);
                j++;
            }
        }
        $('.language-delete').off('click');
        $('.language-delete').click(function () {
            var id_obj = $(this).attr('id');
            id_obj = id_obj.substring(16, id_obj.length);
            $('#language-' + id_obj).remove();
            re_render_language(id_obj);
            count_language--;
        });
    }

    function ren_ngoai_ngu(id, ten_ngoai_ngu, trinh_do_ngoai_ngu){
        var html_return = "<label for='ten_ngoai_ngu' class='col-md-4' id='language-" + id + "'><div class='col-md-12'>";
        html_return += " - <span class='ngoai-ngu'>" + ten_ngoai_ngu + "</span> - Trình độ: <span class='ngoai-ngu'>" + trinh_do_ngoai_ngu + "</span>";
        html_return += "<span class='language-delete' id='language-delete-" + id + "'>&nbsp;x&nbsp;</span></div></label>";
        return html_return;
    }

    function ren_ky_nang(id, ten_ky_nang){
        var html_return = "<label for='ten_ky_nang' class='col-md-4 qualification-holder' id='qualification-" + id + "'><div class='col-md-12'>";
        html_return += " - <span class='ngoai-ngu'>" + ten_ky_nang + "</span>";
        html_return += "<span class='qualification-delete' id='qualification-delete-" + id + "'>&nbsp;x&nbsp;</span></div></label>";
        return html_return;
    }
}
);