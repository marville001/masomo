<!-- Modal For Add Exam -->
<div class="modal fade" id="addexammodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
   <form class="refreshFrm" id="addQuestionFrm" method="post">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Exam</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="refreshFrm" method="post" id="addQuestionFrm">
      <div class="modal-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Exam Name</label>
            <input required type="text" name="examname" class="form-control" placeholder="Enter exam name" autocomplete="off">
          </div>
          <div class="form-group">
            <label>Exam Date</label>
            <input required type="date" name="examdate" class="form-control" autocomplete="off">
          </div>
          <div class="form-group">
            <label>Exam Type</label>
            <select required name="examtype" class="form-control">
              <option value="">Select Exam Type</option>
              <option value="multiple">Multiple Questions</option>
              <option value="upload">Uploaded Exam</option>
            </select>
          </div>
          <div class="form-group">
            <label>Exam Description</label>
            <textarea required name="examdescription" class="form-control" placeholder="Enter Exam Descrition..."></textarea>
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="addexamsubmit" class="btn btn-primary">Add Exam</button>
      </div>
      </form>
    </div>
   </form>
  </div>
</div>



<!-- Modal For Add Question -->
<div class="modal fade" id="modalForAddQuestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
   <form class="refreshFrm" id="addQuestionFrm" method="post">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Question for <br><?php echo $exam_name; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="refreshFrm" method="post" id="addQuestionFrm">
      <div class="modal-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Question</label>
            <input type="hidden" name="examId" value="<?php echo $exId; ?>">
            <input required type="" name="question" id="course_name" class="form-control" placeholder="Input question" autocomplete="off">
          </div>

          <fieldset>
            <legend>Input word for choice's</legend>
            <div class="form-group">
                <label>Choice A</label>
                <input required type="" name="choice_A" id="choice_A" class="form-control" placeholder="Input choice A" autocomplete="off">
            </div>

            <div class="form-group">
                <label>Choice B</label>
                <input required type="" name="choice_B" id="choice_B" class="form-control" placeholder="Input choice B" autocomplete="off">
            </div>

            <div class="form-group">
                <label>Choice C</label>
                <input required type="" name="choice_C" id="choice_C" class="form-control" placeholder="Input choice C" autocomplete="off">
            </div>

            <div class="form-group">
                <label>Choice D</label>
                <input required type="" name="choice_D" id="choice_D" class="form-control" placeholder="Input choice D" autocomplete="off">
            </div>

            <div class="form-group">
                <label>Correct Answer</label>
                <input required type="" name="correctAnswer" id="" class="form-control" placeholder="Input correct answer" autocomplete="off">
            </div>
          </fieldset>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="addquestionsubmit" class="btn btn-primary">Add Quiz</button>
      </div>
      </form>
    </div>
   </form>
  </div>
</div>



<!-- Modal To Create Class -->
<div class="modal fade" id="modalToCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
   <form class="refreshFrm" id="addClassFrm" method="post">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Class</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="refreshFrm" method="post" id="addClassFrm">
      <div class="modal-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Class Code</label>
            <input required type="text" name="classcode" id="class_name" class="form-control" placeholder="Enter class code..." autocomplete="off">
          </div>
          <div class="form-group">
            <label>Class Name</label>
            <input required type="text" name="classname" id="class_name" class="form-control" placeholder="Enter class name..." autocomplete="off">
          </div>
          <div class="form-group">
            <label>Class Description</label>
            <textarea required name="classdescription" id="class_description" class="form-control" placeholder="Enter class Descrition..."></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="addClassSubmit" class="btn btn-primary">Create Class</button>
      </div>
      </form>
    </div>
   </form>
  </div>
</div>


<!-- Modal To Upload Document -->
<div class="modal fade" id="modalToupload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Document</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="col-md-12">
        <div class="form-group">
            <label>File</label>
            <input required type="file" name="file" style="height:60px;padding:12px; 20px"  class="form-control">
          </div>
          <div class="form-group">
            <label>File Description</label>
            <textarea required name="filedescription" class="form-control" placeholder="Enter file Descrition..."></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="uploadSubmit" class="btn btn-primary">Upload</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal To Upload Exam -->
<div class="modal fade" id="uploadexam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Exam</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Exam File</label>
            <input required type="file" name="examfile" style="height:60px;padding:12px; 20px"  class="form-control">
          </div>
          <div class="form-group">
            <label>Exam Instruction</label>
            <textarea required name="examinstructions" class="form-control" placeholder="Enter Exam Descritions..."></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="examuploadsubmit" class="btn btn-primary">Upload</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal To Comment Exams -->
<div class="modal fade" id="examcomment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Comment About Student Performance</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Comment</label>
            <textarea required name="resultcomment" class="form-control" placeholder="Enter comment..."></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="examcommentsubmit" class="btn btn-primary">Comment</button>
      </div>
      </form>
    </div>
  </div>
</div>