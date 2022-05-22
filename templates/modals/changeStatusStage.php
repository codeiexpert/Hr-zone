<!-- Change Stage modal -->
    
<div class="modal hide fade" id="changeStageModal" tabindex="-1"  aria-labelledby="changeStageModalLabel"  data-bs-backdrop="static" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeStageModalLabel">Change stage</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="hr-change-stages" data-type="save_stages">
                <div class="modal-body">                
                        <p>
                            <select  id="entry-stages" class="form-control h-auto">
                                <?php 

                                    // status
                                    if(!empty($selectStagesSql)) {
                                        foreach($selectStagesSql as $list) {
                                                            ?>
                                <option value="<?php echo $list->id?>" <?php if($scheduledInterviewTableSql[0]->stage == $list->id){?> selected <?php } ?> ><?php echo ucfirst($list->states)?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </p>               
                </div>
                <div class="modal-footer">
                    <input type="submit" name="save_stages" class="btn btn-outline-primary" value="Save">
                </div>
                </form>
                </div>
            </div>
        </div>

        <!-- Change Status modal -->
        <div class="modal hide fade" id="changeStatusModal" tabindex="-1" data-bs-backdrop="static"  aria-labelledby="changeStatusModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeStatusModalLabel">Change status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post"  id="hr-change-status" data-type="save_status">
                <div class="modal-body">   
                        <select id="entry-status"  class="form-control h-auto">
                            <?php 
                                if(!empty($selectStatusSql)) {
                                    foreach($selectStatusSql as $list) {
                                                        ?>
                            <option value="<?php echo $list->id?>" <?php if($scheduledInterviewTableSql[0]->status == $list->id){?> selected <?php } ?>><?php echo ucfirst($list->status)?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <?php if (trim($scheduledInterviewTableSql[0]->reason) != '' ): ?>
                            <input type="text" id="gp-reason" class="form-control my-2" required value="<?php echo $scheduledInterviewTableSql[0]->reason; ?>">
                        <?php endif; ?>             
                </div>
                <div class="modal-footer">
                    <input type="submit" name="save_status" class="btn btn-outline-primary" value="Save">
                </div>
                </form>
                </div>
            </div>
        </div>  
