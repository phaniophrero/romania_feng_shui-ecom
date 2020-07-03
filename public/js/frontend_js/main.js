/*price range*/

$('#sl2').slider();

var RGBChange = function () {
    $('#RGB').css('background', 'rgb(' + r.getValue() + ',' + g.getValue() + ',' + b.getValue() + ')')
};

/*scroll to top*/

$(document).ready(function () {
    $(function () {
        $.scrollUp({
            scrollName: 'scrollUp', // Element ID
            scrollDistance: 300, // Distance from top/bottom before showing element (px)
            scrollFrom: 'top', // 'top' or 'bottom'
            scrollSpeed: 300, // Speed back to top (ms)
            easingType: 'linear', // Scroll to top easing (see http://easings.net/)
            animation: 'fade', // Fade, slide, none
            animationSpeed: 200, // Animation in speed (ms)
            scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
            //scrollTarget: false, // Set a custom target element for scrolling to the top
            scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
            scrollTitle: false, // Set a custom <a> title if required.
            scrollImg: false, // Set true to use image
            activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
            zIndex: 2147483647 // Z-Index for the overlay
        });
    });
});

//Change Price & Stock with size
$(document).ready(function () {
    $("#selSize").change(function () {
        var idSize = $(this).val();
        if (idSize == "") {
            return false;
        }
        $.ajax({
            type: 'get',
            url: '/get-product-price',
            data: {
                idSize: idSize
            },
            success: function (resp) {
                // alert(resp);
                // return false;
                var arr = resp.split('#');
                var arr1 = arr[0].split('-');
                $("#getPrice").html("RON " + arr1[0] + "<br><h2>USD " + arr1[1] + "<br>EUR " + arr1[2] + "<br>GBP " + arr1[3] + "</h2>");
                $('#price').val(arr[0]);
                if (arr[1] == 0) {
                    $("#cartButton").hide();
                    $("#Availability").text("Out of Stock");
                } else {
                    $("#cartButton").show();
                    $("#Availability").text("In Stock");
                }
            },
            error: function () {
                alert("Error");
            }
        });
    });
});

//Replace Main Image with Alternate Image
$(document).ready(function () {
    $(".changeImage").click(function () {
        var image = $(this).attr('src');
        $(".mainImage").attr("src", image);
    });
});

// Instantiate EasyZoom instances
var $easyzoom = $(".easyzoom").easyZoom();

// Setup thumbnails example
var api1 = $easyzoom.filter(".easyzoom--with-thumbnails").data("easyZoom");

$(".thumbnails").on("click", "a", function (e) {
    var $this = $(this);

    e.preventDefault();

    // Use EasyZoom's `swap` method
    api1.swap($this.data("standard"), $this.attr("href"));
});

// Setup toggles example
var api2 = $easyzoom.filter(".easyzoom--with-toggle").data("easyZoom");

$(".toggle").on("click", function () {
    var $this = $(this);

    if ($this.data("active") === true) {
        $this.text("Switch on").data("active", false);
        api2.teardown();
    } else {
        $this.text("Switch off").data("active", true);
        api2._init();
    }
});

$().ready(function () {
    //Valiadte Register form on keyup and submit
    $("#registerForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 2,
                accept: "[a-zA-Z]+"
            },
            password: {
                required: true,
                minlength: 6
            },
            email: {
                required: true,
                email: true,
                remote: "/check-email"
            }
        },
        messages: {
            name: {
                required: "Please enter your Name",
                minlength: "Your Name must be atleast 2 characters long",
                accept: "Your Name must contain only letters"
            },
            password: {
                required: "Please enter your Password",
                minlength: "Your Password must be atleast 6 characters long"
            },
            email: {
                required: "Please enter your Email",
                email: "Please enter a valid Email",
                remote: "Email already exists!"
            }
        }
    });

    //Valiadte Register form on keyup and submit
    $("#accountForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 2,
                accept: "[a-zA-Z]+"
            },
            address: {
                required: true,
                minlength: 6
            },
            city: {
                required: true,
                minlength: 2
            },
            state: {
                required: true,
                minlength: 2
            },
            country: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Please enter your Name",
                minlength: "Your Name must be atleast 2 characters long",
                accept: "Your Name must contain only letters"
            },
            address: {
                required: "Please enter your Address",
                minlength: "Your Address must be atleast 6 characters long"
            },
            city: {
                required: "Please enter your City",
                minlength: "Your City must be atleast 2 characters long"
            },
            state: {
                required: "Please enter your State",
                minlength: "Your State must be atleast 2 characters long"
            },
            country: {
                required: "Please enter your Country"
            }
        }
    });

    //Valiadte Login form on keyup and submit
    $("#loginForm").validate({
        rules: {
            email: {
                required: true,
                email: true
            },

            password: {
                required: true
            }
        },
        messages: {
            email: {
                required: "Please enter your Email",
                email: "Please enter a valid Email"
            },
            password: {
                required: "Please enter your Password"
            }
        }
    });

    // Validate Update User Password
    $("#passwordForm").validate({
        rules: {
            current_pwd: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            new_pwd: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            confirm_pwd: {
                required: true,
                minlength: 6,
                maxlength: 20,
                equalTo: "#new_pwd"
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    // Check Current User Password
    $("#current_pwd").keyup(function () {
        var current_pwd = $(this).val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/check-user-pwd',
            data: {
                current_pwd: current_pwd
            },
            success: function (resp) {
                // alert(resp);
                if (resp == "false") {
                    $("#chkPwd").html("<font color='red'>Current Password is incorrect</font>");
                } else if (resp == "true") {
                    $("#chkPwd").html("<font color='green'>Current Password is correct</font>");
                }
            },
            error: function () {
                alert("Error");
            }
        })
    });

    $('#myPassword').passtrength({
        minChars: 4,
        passwordToggle: true,
        tooltip: true,
        eyeImg: "/images/frontend_images/eye.svg"
    });

    // Copy Billing Address to Shipping Address Script
    $("#copyAddress").on('click', function () {
        if (this.checked) {
            $("#shipping_name").val($("#billing_name").val());
            $("#shipping_address").val($("#billing_address").val());
            $("#shipping_city").val($("#billing_city").val());
            $("#shipping_state").val($("#billing_state").val());
            $("#shipping_country").val($("#billing_country").val());
            $("#shipping_zipcode").val($("#billing_zipcode").val());
            $("#shipping_mobile").val($("#billing_mobile").val());
        } else {
            $("#shipping_name").val('');
            $("#shipping_address").val('');
            $("#shipping_city").val('');
            $("#shipping_state").val('');
            $("#shipping_country").val('');
            $("#shipping_zipcode").val('');
            $("#shipping_mobile").val('');
        }

    });
});

function selectPaymentMethod() {
    if ($('#Paypal').is(':checked') || $('#COD').is(':checked') || $('#Stripe').is(':checked')) {
        // alert("checked");
    } else {
        alert("Please select Payment Method");
        return false;
    }
}

function checkZipcode() {
    var zipcode = $("#chkZipcode").val();
    if (zipcode == "") {
        alert("Please enter Zipcode");
        return false;
    }
    $.ajax({
        type: 'post',
        data: {
            zipcode: zipcode
        },
        url: '/check-zipcode',
        success: function (resp) {
            if (resp > 0) {
                $("#zipcodeResponse").html("<font color='green'>This zipcode is available for delivery <font /font>");
            } else {
                $("#zipcodeResponse").html("<font color='red'> This zipcode is not available for delivery</font>");
            }
        },
        error: function () {
            alert("Error");
        }
    });

    // Create a Stripe client.
    var stripe = Stripe('pk_test_qegVFI8E4fynZuP3q9fZlQeg00CGYmCuh8');
    // Create an instance of Elements.
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {
        style: style,
        hidePostalCode: true
    });

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.on('change', function (event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

}
