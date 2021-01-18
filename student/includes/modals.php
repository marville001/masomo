<!-- Modal To Create Class -->
<div style="z-index:2000" class="modal" id="joinClassModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="joinClassModalLabel">Create Class</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="joinClassFrm">
        <div class="modal-body">  
          <div class="col-md-12">
            <div class="form-group">
              <label>Class Code</label>
              <input required type="text" name="classcode" id="class_code" class="form-control" placeholder="Enter class code..." autocomplete="off">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="joinClassSubmit" class="btn btn-primary">Join Class</button>
        </div>
      </form>
    </div>
  </div> 
</div>

<!-- Submit Exam Answers Modal-->
<div class="modal fade" id="submitExamModal" tabindex="-1" role="dialog" aria-labelledby="submitExamModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="submitExamModalLabel">Upload Answers Document</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label>Document</label>
            <input required type="file" name="examanswers" style="height:60px;padding:12px; 20px"    class="form-control"/>
          </div>
          <p>NB: You cannot submit another document</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="submitExamAnswers" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>