$(document).ready(function(){
	var url_site = $('base').attr('href');
	$('.active-company').click(function(){
        var _sefl = $(this);
        var company_id = $(this).attr('data-id');
        var request = $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url_site + "/company/active",
            method: "POST",
            data: {
                'company': company_id
            },
            dataType: "json"
        });

        request.done(function (msg) {
            if (msg.code == 200) {
               _sefl.addClass('hidden-object').removeClass('show-object');
               _sefl.parent().find(".unactive-company").addClass('show-object').removeClass('hidden-object');
            }
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    });

    $('.unactive-company').click(function(){
        var _sefl = $(this);
        var company_id = $(this).attr('data-id');
        var request = $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url_site + "/company/unactive",
            method: "POST",
            data: {
                'company': company_id
            },
            dataType: "json"
        });

        request.done(function (msg) {
            if (msg.code == 200) {
               _sefl.addClass('hidden-object').removeClass('show-object');
               _sefl.parent().find(".active-company").addClass('show-object').removeClass('hidden-object');
            }
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    });

    $('.apply-cv').click(function(){
        var _sefl = $(this);
        var apply_id = $(this).attr('data-id');
        var request = $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url_site + "/apply/active",
            method: "POST",
            data: {
                'apply': apply_id
            },
            dataType: "json"
        });

        request.done(function (msg) {
            if (msg.code == 200) {
               _sefl.addClass('hidden-object').removeClass('show-object');
               _sefl.parent().find(".unapply-cv").addClass('show-object').removeClass('hidden-object');
            }
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    });

    $('.unapply-cv').click(function(){
        var _sefl = $(this);
        var apply_id = $(this).attr('data-id');
        var request = $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url_site + "/apply/unactive",
            method: "POST",
            data: {
                'apply': apply_id
            },
            dataType: "json"
        });

        request.done(function (msg) {
            if (msg.code == 200) {
               _sefl.addClass('hidden-object').removeClass('show-object');
               _sefl.parent().find(".apply-cv").addClass('show-object').removeClass('hidden-object');
            }
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    });

    $('.active-post').click(function(){
        var _sefl = $(this);
        var post_id = $(this).attr('data-id');
        var request = $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url_site + "/post/active",
            method: "POST",
            data: {
                'post': post_id
            },
            dataType: "json"
        });

        request.done(function (msg) {
            if (msg.code == 200) {
               _sefl.addClass('hidden-object').removeClass('show-object');
               _sefl.parent().find(".unactive-post").addClass('show-object').removeClass('hidden-object');
            }
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    });

    $('.unactive-post').click(function(){
        var _sefl = $(this);
        var post_id = $(this).attr('data-id');
        var request = $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url_site + "/post/unactive",
            method: "POST",
            data: {
                'post': post_id
            },
            dataType: "json"
        });

        request.done(function (msg) {
            if (msg.code == 200) {
               _sefl.addClass('hidden-object').removeClass('show-object');
               _sefl.parent().find(".active-post").addClass('show-object').removeClass('hidden-object');
            }
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
	});

    $('.active-spa').click(function(){
        var _sefl = $(this);
        var jobtype_id = $(this).attr('data-id');
        var request = $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url_site + "/jobtype/active",
            method: "POST",
            data: {
                'jobtype': jobtype_id
            },
            dataType: "json"
        });

        request.done(function (msg) {
            if (msg.code == 200) {
               _sefl.addClass('hidden-object').removeClass('show-object');
               _sefl.parent().find(".unactive-spa").addClass('show-object').removeClass('hidden-object');
            }
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    });

    $('.unactive-spa').click(function(){
        var _sefl = $(this);
        var jobtype_id = $(this).attr('data-id');
        var request = $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url_site + "/jobtype/unactive",
            method: "POST",
            data: {
                'jobtype': jobtype_id
            },
            dataType: "json"
        });

        request.done(function (msg) {
            if (msg.code == 200) {
               _sefl.addClass('hidden-object').removeClass('show-object');
               _sefl.parent().find(".active-spa").addClass('show-object').removeClass('hidden-object');
            }
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    });

    $('.active-city').click(function(){
        var _sefl = $(this);
        var city_id = $(this).attr('data-id');
        var request = $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url_site + "/city/active",
            method: "POST",
            data: {
                'city': city_id
            },
            dataType: "json"
        });

        request.done(function (msg) {
            if (msg.code == 200) {
               _sefl.addClass('hidden-object').removeClass('show-object');
               _sefl.parent().find(".unactive-city").addClass('show-object').removeClass('hidden-object');
            }
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    });

    $('.unactive-city').click(function(){
        var _sefl = $(this);
        var city_id = $(this).attr('data-id');
        var request = $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url_site + "/city/unactive",
            method: "POST",
            data: {
                'city': city_id
            },
            dataType: "json"
        });

        request.done(function (msg) {
            if (msg.code == 200) {
               _sefl.addClass('hidden-object').removeClass('show-object');
               _sefl.parent().find(".active-city").addClass('show-object').removeClass('hidden-object');
            }
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    });

    $('.active-district').click(function(){
        var _sefl = $(this);
        var district_id = $(this).attr('data-id');
        var request = $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url_site + "/district/active",
            method: "POST",
            data: {
                'district': district_id
            },
            dataType: "json"
        });

        request.done(function (msg) {
            if (msg.code == 200) {
               _sefl.addClass('hidden-object').removeClass('show-object');
               _sefl.parent().find(".unactive-district").addClass('show-object').removeClass('hidden-object');
            }
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    });

    $('.unactive-district').click(function(){
        var _sefl = $(this);
        var district_id = $(this).attr('data-id');
        var request = $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url_site + "/district/unactive",
            method: "POST",
            data: {
                'district': district_id
            },
            dataType: "json"
        });

        request.done(function (msg) {
            if (msg.code == 200) {
               _sefl.addClass('hidden-object').removeClass('show-object');
               _sefl.parent().find(".active-district").addClass('show-object').removeClass('hidden-object');
            }
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    });

    $('.vip-cv').click(function(){
        var _sefl = $(this);
        var cv_id = $(this).attr('data-id');
        var request = $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url_site + "/curriculumvitae/vip",
            method: "POST",
            data: {
                'cv': cv_id
            },
            dataType: "json"
        });

        request.done(function (msg) {
            if (msg.code == 200) {
               _sefl.addClass('hidden-object').removeClass('show-object');
               _sefl.parent().find(".unvip-cv").addClass('show-object').removeClass('hidden-object');
            }
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    });

    $('.unvip-cv').click(function(){
        var _sefl = $(this);
        var cv_id = $(this).attr('data-id');
        var request = $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url_site + "/curriculumvitae/unvip",
            method: "POST",
            data: {
                'cv': cv_id
            },
            dataType: "json"
        });

        request.done(function (msg) {
            if (msg.code == 200) {
               _sefl.addClass('hidden-object').removeClass('show-object');
               _sefl.parent().find(".vip-cv").addClass('show-object').removeClass('hidden-object');
            }
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    });

    $('.vip-job').click(function(){
        var _sefl = $(this);
        var job_id = $(this).attr('data-id');
        var request = $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url_site + "/job/vip2",
            method: "POST",
            data: {
                'job': job_id
            },
            dataType: "json"
        });

        request.done(function (msg) {
            if (msg.code == 200) {
               _sefl.addClass('hidden-object').removeClass('show-object');
               _sefl.parent().find(".vip2-job").addClass('show-object').removeClass('hidden-object');
            }
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    });

    $('.vip2-job').click(function(){
        var _sefl = $(this);
        var job_id = $(this).attr('data-id');
        var request = $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url_site + "/job/unvip",
            method: "POST",
            data: {
                'job': job_id
            },
            dataType: "json"
        });

        request.done(function (msg) {
            if (msg.code == 200) {
               _sefl.addClass('hidden-object').removeClass('show-object');
               _sefl.parent().find(".unvip-job").addClass('show-object').removeClass('hidden-object');
            }
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    });

    $('.unvip-job').click(function(){
        var _sefl = $(this);
        var job_id = $(this).attr('data-id');
        var request = $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url_site + "/job/vip",
            method: "POST",
            data: {
                'job': job_id
            },
            dataType: "json"
        });

        request.done(function (msg) {
            if (msg.code == 200) {
               _sefl.addClass('hidden-object').removeClass('show-object');
               _sefl.parent().find(".vip-job").addClass('show-object').removeClass('hidden-object');
            }
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    });

    $('#avatar-image').on('click', function (e) {
        $('#image-img').click();
    });
    $('#image-img').on('change', function (e) {
        var fileInput = this;
        if (fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#avatar-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(fileInput.files[0]);
        }
    });
});