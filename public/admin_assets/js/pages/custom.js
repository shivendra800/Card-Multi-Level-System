$(document).ready(function() {
    // check Admin Password is correct or Not
    $("#current_password").keyup(function() {
        var current_password = $("#current_password").val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/admin/check-current-password",
            data: { current_password: current_password },
            success: function(resp) {
                // alert(resp);
                if (resp == "false") {
                    $("#check_password").html("<font color='red'>Current Password is Incorrect!</font>");
                } else if (resp == "true") {
                    $("#check_password").html("<font color='green'>Current Password is Correct.</font>");
                }
            },
            error: function() {
                alert("Error");
            },
        });
    });

    // check assign data---
    // $("#assign_state").keyup(function(){
    //     var assign_state = $("#assign_state").val();
    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         type: "post",
    //         url: "/admin/check-current-assign-state",
    //         data: { assign_state: assign_state },
    //         success: function (resp) {
    //             // alert(resp);
    //             if (resp == "false") {
    //                 $("#check-assign_state").html("<font color='red'>check- is Incorrect!</font>");
    //             } else if (resp == "true") {
    //                 $("#check-assign_state").html("<font color='green'>assign_state is Correct.</font>");
    //             }
    //         },
    //         error: function () {
    //             alert("Error");
    //         },
    //     });
    // });

    // end assign data


    $(document).on("click", ".updatedistrictStatus", function() {
        var status = $(this).children("i").attr("status");
        var district_id = $(this).attr("district_id");
        // alert(district_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/admin/update-district-status",
            data: { status: status, district_id: district_id },
            success: function(resp) {
                // alert(resp);
                if (resp['status'] == 0) {
                    $("#district-" + district_id).html("<i style='font-size:25px;' class='fas fa-pause' status='InActive'></i>");
                } else if (resp['status'] == 1) {
                    $("#district-" + district_id).html("<i style='font-size:25px;' class='fas fa-play' status='Active'></i>");
                }
            },
            error: function() {
                alert("Error");
            }
        })

    });
    $(document).on("click", ".updatestateStatus", function() {
        var status = $(this).children("i").attr("status");
        var state_id = $(this).attr("state_id");
        // alert(state_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/admin/update-state-status",
            data: { status: status, state_id: state_id },
            success: function(resp) {
                // alert(resp);
                if (resp['status'] == 0) {
                    $("#state-" + state_id).html("<i style='font-size:25px;' class='fas fa-pause' status='InActive'></i>");
                } else if (resp['status'] == 1) {
                    $("#state-" + state_id).html("<i style='font-size:25px;' class='fas fa-play' status='Active'></i>");
                }
            },
            error: function() {
                alert("Error");
            }
        })

    });
    $(document).on("click", ".updatecityStatus", function() {
        var status = $(this).children("i").attr("status");
        var city_id = $(this).attr("city_id");
        // alert(city_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/admin/update-city-status",
            data: { status: status, city_id: city_id },
            success: function(resp) {
                // alert(resp);
                if (resp['status'] == 0) {
                    $("#city-" + city_id).html("<i style='font-size:25px;' class='fas fa-pause' status='InActive'></i>");
                } else if (resp['status'] == 1) {
                    $("#city-" + city_id).html("<i style='font-size:25px;' class='fas fa-play' status='Active'></i>");
                }
            },
            error: function() {
                alert("Error");
            }
        })

    });

    // Delete
    $(document).on("click", ".confirmDelete", function() {
        var module = $(this).attr('module');
        var moduleid = $(this).attr('moduleid');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
                window.location = "/admin/delete-" + module + "/" + moduleid;
            }
        })

    });
});