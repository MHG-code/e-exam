<?php
  require_once('./partials/header.php');
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $config->insert($_POST, 'question');
  }
  
?>
    <!-- Page Content  -->
  <div id="content" class="p-4 p-md-5 pt-5">
    <h2 class="text-center pb-5">Add Questions</h2>
    <form method="POST" action="">

        <!-- Exam Name -->
        <div class="form-outline mb-4 col-sm-4 mx-auto">
            <label class="form-label" for="form4Example2">Exam Name</label>
            <input required type="text" name="exam" id="form4Example2" class="form-control" />
        </div>

        <!-- Question input -->
        <div class="form-outline mb-4 col-sm-4 mx-auto">
            <label class="form-label" for="form4Example1">Question</label>
            <textarea name="question" class="form-control" id="form4Example3" rows="4" required></textarea>
        </div>
      
        <!-- options input -->
        <div class="form-outline mb-4 col-sm-4 mx-auto">
            <label class="form-label" for="form4Example2">Option 1</label>
            <input required type="text" name="option1" id="form4Example2" class="form-control" />
        </div>

        <div class="form-outline mb-4 col-sm-4 mx-auto">
            <label class="form-label" for="form4Example2">Option 2</label>
            <input required type="text" name="option2" id="form4Example2" class="form-control" />
        </div>

        <div class="form-outline mb-4 col-sm-4 mx-auto">
            <label class="form-label" for="form4Example2">Option 3</label>
            <input required type="text" name="option3" id="form4Example2" class="form-control" />
        </div>

        <div class="form-outline mb-4 col-sm-4 mx-auto">
            <label class="form-label" for="form4Example2">Option 4</label>
            <input required type="text" name="option4" id="form4Example2" class="form-control" />
        </div>
      
        <!-- Ans input -->
        <div class="form-outline mb-4 col-sm-4 mx-auto">
            <label class="form-label" for="form4Example2">Answer</label>
            <input required type="text" name="ans" id="form4Example2" class="form-control" />
        </div>

        <!-- Time input -->
        <div class="form-outline mb-4 col-sm-4 mx-auto">
            <label class="form-label" for="form4Example2">Time</label>
            <input required type="text" name="time" id="form4Example2" class="form-control" />
        </div>
      
        <!-- Submit button -->
        <input type="file" size="60"  class="mb-4 col-sm-4 form-control-file mx-auto" accept=".xls .xlsx"/>
        <button type="submit" class="btn btn-primary btn-block mb-4 col-sm-4 mx-auto">Question Add</button>
      
    </form>
  </div>
</div>

<?php
  require_once('./partials/footer.php');
?>