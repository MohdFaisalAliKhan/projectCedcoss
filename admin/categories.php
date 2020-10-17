<?php  
//     HOW TO NOT MAKE TAG ID PRIMARY KEY AND DO WE NEED TO MAKE SAME PRODUCTS TAG ID SAME ?
?>

<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php include('configDatabase2.php'); ?>
<?php
if(isset($_POST['submit'])) {
    $categoryname=isset($_POST['categoryName'])?$_POST['categoryName']:'';
    $categoryid=isset($_POST['categoryId'])?$_POST['categoryId']:'';

    //TO CHECK FOR DUPLICATE ENTRY
    $categoryNameDuplicate=mysqli_query($conn, "SELECT * FROM categories WHERE `name`='$categoryname'"); 
    $categoryIdDuplicate=mysqli_query($conn, "SELECT * FROM tags WHERE `category_id`='$categoryid'");
    if($categoryNameDuplicate->num_rows>0) {
        trigger_error("This category name already exists in database", E_USER_WARNING);
    }
    else if($categoryIdDuplicate->num_rows>0) {
        trigger_error("This category ID already exists", E_USER_WARNING);
    }
    
    else {
        $sql="INSERT INTO categories(`category_id`,`name`) VALUES ('".$categoryid."', '".$categoryname."')" ;
        if ($conn->query($sql) === true) {
        echo "New record created successfully"; 
        echo "<span class='input-notification success png_bg'>Successful message</span>";   
        }  
        else {    
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }
    
    
    
}




?>
        
        <div id="main-content"> <!-- Main Content Section with everything -->
            
            <noscript> <!-- Show a notification if the user has disabled javascript -->
                <div class="notification error png_bg">
                    <div>
                        Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
                    </div>
                </div>
            </noscript>
            
            <!-- Page Head -->
            <h2>Welcome John</h2>
            <p id="page-intro">What would you like to do?</p>
            
            <ul class="shortcut-buttons-set">
                
                <li><a class="shortcut-button" href="#"><span>
                    <img src="resources/images/icons/pencil_48.png" alt="icon" /><br />
                    Write an Article
                </span></a></li>
                
                <li><a class="shortcut-button" href="#"><span>
                    <img src="resources/images/icons/paper_content_pencil_48.png" alt="icon" /><br />
                    Create a New Page
                </span></a></li>
                
                <li><a class="shortcut-button" href="#"><span>
                    <img src="resources/images/icons/image_add_48.png" alt="icon" /><br />
                    Upload an Image
                </span></a></li>
                
                <li><a class="shortcut-button" href="#"><span>
                    <img src="resources/images/icons/clock_48.png" alt="icon" /><br />
                    Add an Event
                </span></a></li>
                
                <li><a class="shortcut-button" href="#messages" rel="modal"><span>
                    <img src="resources/images/icons/comment_48.png" alt="icon" /><br />
                    Open Modal
                </span></a></li>
                
            </ul><!-- End .shortcut-buttons-set -->
            
            <div class="clear"></div> <!-- End .clear -->
            
            <div class="content-box"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    
                    <h3>Content box</h3>
                    
                    <ul class="content-box-tabs">
                        <li><a href="#tab1" class="default-tab">Manage</a></li> <!-- href must be unique and match the id of target div -->
                        <li><a href="#tab2">Add</a></li>
                    </ul>
                    
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                
                
                <div class="content-box-content">
                    
                    <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
                        
                        <div class="notification attention png_bg">
                            <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                This is a Fontent Box. You can put whatever you want in it. By the way, you can close this notification with the top-right cross.
                            </div>
                        </div>
                        
                        <table>
                            
                            <thead>
                                <tr>
                                   <th><input class="check-all" type="checkbox" /></th>
                                   <th>Category Name</th>
                                   <th>Category ID</th>
                                   <th>Action</th>
                                </tr>
                                
                            </thead>
                         
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <div class="bulk-actions align-left">
                                            <select name="dropdown">
                                                <option value="option1">Choose an action...</option>
                                                <option value="option2">Edit</option>
                                                <option value="option3">Delete</option>
                                            </select>
                                            <a class="button" href="#">Apply to selected</a>
                                        </div>
                                        
                                        <div class="pagination">
                                            <a href="#" title="First Page">&laquo; First</a><a href="#" title="Previous Page">&laquo; Previous</a>
                                            <a href="#" class="number" title="1">1</a>
                                            <a href="#" class="number" title="2">2</a>
                                            <a href="#" class="number current" title="3">3</a>
                                            <a href="#" class="number" title="4">4</a>
                                            <a href="#" title="Next Page">Next &raquo;</a><a href="#" title="Last Page">Last &raquo;</a>
                                        </div> <!-- End .pagination -->
                                        <div class="clear"></div>
                                    </td>
                                </tr>
                            </tfoot>


                            <?php

                            echo "<tbody id='tableBody'>";
                             $data = "SELECT * FROM categories" ;
                             $check=mysqli_query($conn, $data);
                             $no_of_rows = mysqli_num_rows($check);//returns the number of rows
                            
                             if ($no_of_rows > 0) {
                            // output data of each row
                                 while ($row = mysqli_fetch_array($check)) //to fetch a row as an associative array.
                                  { 
                                    
                                    echo "<tr>";
                                         echo "<td><input type='checkbox' /></td>";
                                         echo "<td>".$row['name']."</td>";
                                         echo "<td>".$row['category_id']."</td>";
                                      echo "<td>";
                                            //<!-- Icons -->
                                            echo "<a href='#' title='Edit'><img src='resources/images/icons/pencil.png' alt='Edit' /></a>";
                                            echo "<a href='deleteCategories.php?ID=".$row['category_id']."' title='Delete'><img src='resources/images/icons/cross.png' alt='Delete' /></a>"; 
                                     echo "</td>";
                                    echo "</tr>";
                                echo "</tbody>";
                                 }
                            }
                            else {
                                echo "Record not found..";
                            }  
                            ?>
                         </table>
                        
                    </div> <!-- End #tab1 -->
                    
                    <div class="tab-content" id="tab2">
                    
                        <form action="#" method="post">
                            
                            <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                                
                                <p>
                                    <label>Category Name</label>
                                        <input class="text-input small-input" type="text" id="small-input" name="categoryName" required />  <!-- Classes for input-notification: success, error, information, attention -->
                                        <!-- SUCCESSFULL MSG -->
                                        <br /><small>Please enter tag name</small>
                                </p>
                                
                                <p>
                                    <label>Category ID</label>
                                    <input class="text-input medium-input datepicker" type="text" id="tagId" name="categoryId" requierd /> <!--<span class="input-notification error png_bg">Error message</span>  -->
                                    <!-- ERROR MSG -->
                                </p>

                                <p>
                                    <input class="button" name='submit' type="submit" value="Submit" />
                                </p>
                                
                            </fieldset>
                            
                            <div class="clear"></div><!-- End .clear -->
                            
                        </form>
                        
                    </div> <!-- End #tab2 -->        
                    
                </div> <!-- End .content-box-content -->
                
            </div> <!-- End .content-box -->

            <!-- Start Notifications -->
            
            <!-- <div class="notification attention png_bg">
                <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div>
                    Attention notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero. 
                </div>
            </div>
            
            <div class="notification information png_bg">
                <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div>
                    Information notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
                </div>
            </div>
            
            <div class="notification success png_bg">
                <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div>
                    Success notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
                </div>
            </div>
            
            <div class="notification error png_bg">
                <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div>
                    Error notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
                </div>
            </div> -->
            
            <!-- End Notifications -->
            
            <?php   include('footer.php'); ?>