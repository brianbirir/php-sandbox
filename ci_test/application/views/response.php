<div class="row">
	<?php

        $CI =& get_instance();
        $CI->load->model('responsetitle_model');
        $CI->load->model('user_model');


		if(!$response_data)
		{
				

	?>
		<div class="alert alert-warning" role="alert">
			<strong>Warning:</strong> No Data!
		</div>
	<?php
		}
		else 
		{
			//var_dump($response_data);
	?>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Responses</h3>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th>Response Title</th>
                                    <th>Users</th>
                                    <th>Due Date</th>
                                    <!-- <th>Actions</th> -->
                                </tr>
                                <?php
                                    foreach ($response_data as $response_row)
                                    {
                                        echo "<tr>";
                                        echo "<td>".$response_row->response_id."</td>";
                                        echo "<td>".$CI->responsetitle_model->getResponseTitleName($response_row->ResponseTitle_title_id)."</td>";
                                        
                                        $users = unserialize($response_row->users_id);
                                        
                                        echo "<td>";
                                        
                                        foreach ($users as $value) {
                                            echo "<li>".$CI->user_model->getUserNames($value)."</li>";
                                        }
                                        
                                        echo "</td>";
                                        echo "<td>".$response_row->due_date."</td>";
                                        echo "</tr>";
                                    } 
                                ?>
                            </tbody>
                        <table>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>
</div>


<!-- risk registration form -->
<div class="row">
    <div id="reg-risk-form">
        <div class="col-md-12">
        
            <?php
                $attributes = array("class" => "ui form", "id" => "response-reg-form", "name" => "response-form");
                echo form_open("response/add", $attributes);
            ?>

            <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Risk Response</h3>
                                <div id="add-response-btn" class="btn btn-sm btn-primary btn-add pull-right" onclick="new_row()">Add Response</div>
                            </div>
                            <div class="box-body">
                                <table class="table table-hover">
                                    <tbody id="response-table-body">
                                        <tr>
                                            <!-- <th>Risk Response ID</th> -->
                                            <th>Response Title</th>
                                            <th>Register User</th>
                                            <th>Target Date</th>
                                        </tr>
                                        <tr id="response-row">

                                            <?php 
                                                /** check if response titles exist for this given risk register
                                                 * if not display input text field
                                                 * if they do exist display select drop down of those response titles
                                                 */
                                                if(!$select_response_name)
                                                {
                                            ?>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" name="response_title" placeholder="Risk Response Title" type="text" value="<?php echo set_value('response_title'); ?>" required/>
                                                </div>
                                            </td>
                                            <?php } else { ?>
                                            <td>
                                                <div class="form-group">
                                                    <select name="response_title" class="form-control select2 response-title">
                                                        <?php 
                                                            foreach ($select_response_name as $key => $value) 
                                                            {
                                                                echo "<option value=".$key.">".$value."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                    <!-- button for adding response title to drop down -->
                                                    <button type="button" class="btn btn-default btn-xs btn-reg" data-toggle="modal" data-target="#response-title-modal">Add Title</button>
                                                </div>
                                            </td>
                                            <?php } ?>
                                            <td>
                                                <div class="form-group">
                                                    <select multiple="multiple" name="user[]" class="form-control select-users">
                                                        <?php 
                                                            foreach ($select_user as $key => $value) 
                                                            {
                                                                echo "<option value=".$key.">".$value."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input data-provide="datepicker" data-date-format="yyyy-mm-dd" class="form-control" name="date" placeholder="Risk Response Date" type="text" value="<?php echo set_value('date'); ?>" required/>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
            </div>

            <input name="btn_reg_response" type="submit" class="btn btn-success btn-reg pull-right" value="Add Response" />

            <?php echo form_close(); ?>
        </div>

        <!-- modal for displaying form to add response title -->
        <div class="modal fade" id="response-title-modal" tabindex="-1" role="dialog" aria-labelledby="ResponseModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Response Title</h4>
              </div>
              <div class="modal-body">
                
                <div style="display: none;" id="response-modal-alert-warning" class="alert alert-warning fade in" role="alert">
                    <strong>Warning!</strong> Please fill the response title field!
                </div>

                <div style="display: none;" id="response-modal-alert-success" class="alert alert-success fade in" role="alert">
                    <strong>Success!</strong> The response title has been registered successfully!
                </div>

                <div style="display: none;" id="response-modal-alert-danger" class="alert alert-danger fade in" role="alert">
                </div>

                <?php
                    $attributes = array("class" => "ui form", "id" => "response-title-form", "name" => "response-title-form");
                    echo form_open("", $attributes);
                ?>
                    
                    <div class="form-group">
                        <label for="response_title_modal">Response Title</label>
                        <input id="response-modal-title" class="form-control" name="response_title_modal" type="text" value="<?php echo set_value('response_title_modal'); ?>" required/>
                    </div>
    
                <?php echo form_close(); ?>   

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="add-response-title" type="button" class="btn btn-primary btn-reg">Add Title</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        <!-- JS code to register the response title asynchronously -->
        <script type="text/javascript">
            $(document).ready(function(){

                // register the response title asynchronously
                $('#add-response-title').click(function(event){

                    event.preventDefault();

                    var response_title = $('#response-modal-title').val();
                    var response_project_id = $('#response-modal-project-id').val();

                    if(response_title == '')
                    {
                        $("#response-modal-alert-warning").show();
                    } else {
                        $.ajax({
                            url:  "<?php echo base_url(); ?>" + "response/ajax_response",
                            type: "POST",
                            data: {response_name: response_title},
                            dataType: "JSON"
                        })
                        .done(function(response) {
                            $("#response-modal-alert-success").show();
                            
                            // remove options from response title select drop down
                            $('.response-title option').remove();
                           
                            // add new options from data
                            $.each( response, function( key, value ) {
                                $('.response-title').append('<option value="' + key + '">' + value + '</option>');
                            });
                        })
                        .fail(function(xhr) {
                            $('#response-modal-alert-danger').html('<p>An error has occurred</p>').show();
                            console.log(xhr);
                        }); 
                    }
                });

                // get risk subcategory dropdown based on selected risk category
                $('select[name="main_category"]').change(function(){

                    // get value from selected option
                    var category_value = $(this).val();

                    // use ajax call to get subcategories
                    $.ajax({
                        url:  "<?php echo base_url(); ?>" + "subcategory/get_subcategory_list",
                        type: "POST",
                        data: {category_id: category_value},
                        dataType: "JSON"
                    })
                    .done(function(response) {
                        // remove options from subcategory drop down
                        $('#subcategory-select option').remove();
                        
                        // add new options from response
                        $.each( response, function( key, value ) {
                            $('#subcategory-select').append('<option value="' + key + '">' + value + '</option>');
                        });
                    })
                    .fail(function(xhr) {
                        alert("Unable to retrieve subcategory data");
                    });
                })
            });
        </script>
    </div>
</div>