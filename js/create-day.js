$(document).ready(function(){
 
    // show html form when 'create day' button was clicked
    $(document).on('click', '.create-day-button', function(){

        var create_day_html=`
            <!-- 'create day' html form -->
            <form id='create-day-form' action='#' method='post' border='0'>
                <table class='table table-hover table-responsive table-bordered'>
            
                    <!-- name field -->
                    <tr>
                        <td>Name</td>
                        <td><input type='text' name='name' class='form-control' required /></td>
                    </tr>
            
                    <!-- description field -->
                    <tr>
                        <td>Description</td>
                        <td><input type='text' min='1' name='description' class='form-control' required /></td>
                    </tr>
            
                    <!-- date field -->
                    <tr>
                        <td>Date</td>
                        <td><input type='text' min='1' name='date' class='form-control' required /></td>
                    </tr>
            
                    <!-- button to submit form -->
                    <tr>
                        <td></td>
                        <td>
                            <button type='submit' class='btn btn-primary data-id=  '>
                                <span class='glyphicon glyphicon-plus'></span> Create Day
                            </button>
                        </td>
                    </tr>
            
                </table>
            </form>`;

        // chage page title
        changePageTitle("Create Day");

        // inject html to 'page-content' of our app
        $("#page-content").html(create_day_html);
    });

    // will run if create day form was submitted
    $(document).on('submit', '#create-day-form', function(){
        
        // get form data
        var form_data=JSON.stringify($(this).serializeObject());

        // submit form data to api
        $.ajax({
            url: "http://localhost/api/track_rest_api/api/days/create.php",
            type : "POST",
            contentType : 'application/json',
            data : form_data,
            success : function(result) {
                // day was created, go back to days list
                showDays();
            },
            error: function(xhr, resp, text) {
                // show error to console
                console.log(xhr, resp, text);
            }
        });
        
        return false;

    });
});