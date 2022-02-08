$(document).ready(function(){
 
    // show list of day on first load
    showDays();
 
});
 
// function to show list of days
function showDays(){
    // get list of days from the API
    $.getJSON("http://localhost/api/track_rest_api/api/days/read.php", function(data){

        // html for listing days
        var read_days_html=`
        <!-- when clicked, it will load the create day form -->
        <div id='create-day' class='btn btn-primary pull-right m-b-15px create-day-button'>
            <span class='glyphicon glyphicon-plus'></span> Create Day
        </div>
        <!-- start table -->
        <table class='table table-bordered table-hover'>
        
            <!-- creating our table heading -->
            <tr>
                <th class='w-25-pct'>Name</th>
                <th class='w-10-pct'>Description</th>
                <th class='w-15-pct'>Date</th>
                <th class='w-25-pct text-align-center'>Actions</th>
            </tr>`;
        
            // loop through returned list of data
            $.each(data.records, function(key, val) {
            
                // creating new table row per record
                read_days_html+=`
                    <tr>
            
                        <td>` + val.name + `</td>
                        <td>` + val.description + `</td>
                        <td>` + val.date + `</td>
            
                        <!-- 'action' buttons -->
                        <td>
                            <!-- read day button -->
                            <button class='btn btn-primary m-r-10px read-one-day-button' data-id='` + val.id + ` data-date='` + val.date + `'>
                                <span class='glyphicon glyphicon-eye-open'></span> Read
                            </button>
            
                            <!-- edit button -->
                            <button class='btn btn-info m-r-10px update-day-button' data-id='` + val.id + `'>
                                <span class='glyphicon glyphicon-edit'></span> Edit
                            </button>
            
                            <!-- delete button -->
                            <button class='btn btn-danger delete-day-button' data-id='` + val.id + `'>
                                <span class='glyphicon glyphicon-remove'></span> Delete
                            </button>
                        </td>
            
                    </tr>`;
            });
        
        // end table
        read_days_html+=`</table>`;

        // inject to 'page-content' of our app
        $("#page-content").html(read_days_html);

        // chage page title
        changePageTitle("Read Days");

    });
}

// when a 'read days' button was clicked
$(document).on('click', '.read-days-button', function(){
    showDays();
});