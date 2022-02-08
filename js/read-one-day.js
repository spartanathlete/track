$(document).ready(function(){
 
    // handle 'read one' button click
    $(document).on('click', '.read-one-day-button', function(){
        
        // get day id
        var id = $(this).attr('data-id');

        // read day record based on given ID
        $.getJSON("http://localhost/api/track_rest_api/api/days/read-one.php?id=" + id, function(data){
            
            $.getJSON("http://localhost/api/track_rest_api/api/days/read-exercices.php?id=" + data.id, function(data_){
                
                // start html
                var read_one_day_html=`
                
                <!-- when clicked, it will show the day's list -->
                <div id='read-days' class='btn btn-primary pull-right m-b-15px read-days-button'>
                    <span class='glyphicon glyphicon-list'></span> Read Days
                </div>
                <!-- day data will be shown in this table -->
                <table class='table table-bordered table-hover'>
                
                    <!-- day name -->
                    <tr>
                        <td class='w-30-pct'>Name</td>
                        <td class='w-70-pct'>` + data.name + `</td>
                    </tr>
                
                    <!-- day description -->
                    <tr>
                        <td>Description</td>
                        <td>` + data.description + `</td>
                    </tr>
                
                    <!-- day date -->
                    <tr>
                        <td>Date</td>
                        <td>` + data.date + `</td>
                    </tr>
                
                </table>`;

                var read_day_exercices=`
                    <table class='table table-bordered table-hover'>
                        <tr>
                            <td>Exercice</td>
                            <td>Reps</td>
                            <td>Sets</td>
                            <td>Weight</td>
                        </tr>`;

                $.each(data_.records, function(key, val) {
                    read_day_exercices += `
                        <tr>
                            <td>` + val.name + `</td>
                            <td>` + val.reps + `</td>
                            <td>` + val.sets + `</td>
                            <td>` + val.weight + `</td>
                        <tr>`;
                });

                read_day_exercices += `</table>`;

                // inject html to 'page-content' of our app
                $("#page-content").html(read_one_day_html);
                $("#page-content").append(read_day_exercices);
                
                // chage page title
                changePageTitle("Day Details");
            
            });
        });
    });
});