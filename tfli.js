    function val_url() {

        // first validate all the fields, all are required and need to be in the correct format
        // remember that the date and time is a string when it arrives here

        //  set defaults (expiry time as it is optional)

        var url_expiry = "";

        var url_title = document.getElementById("txtTitle").value;
        var url_add = document.getElementById("txtUrl").value;
        var url_expiry_val = document.getElementById("txtExpiry").value;
        var url_array = [];
        
        if (url_expiry_val) { url_expiry = url_expiry_val};

        var err_message = "";

        if ( !url_title || !url_add ) {
            var err_message = "Please ensure you enter a title, a web address and an expiry date.";
        }

        if (!err_message || err_message === "") {

            // if here, there is no error, so wrap the values in a JSON array and continue

            url_array = {
                'url_title' : url_title,
                'url_add' : url_add,
                'url_expiry' : url_expiry
            }

            convert_url(url_array);

        } else {

            alert(err_message);
            return;

        }

    }

    function convert_url(url_array) {

        // connect to php and pass the json string

        var code_action = "reduce_url";

        $.ajax({ 
         type: "POST",
         url:"tfli_ajax.php",
         data: {code_action : code_action, url_data : url_array},
            success: function(response){ 

                if (response === "error") {
                    alert ("There has been an error and I cannot continue.")
                    return;
                } else {
                    location.reload();
                }

            },
         });

    }
