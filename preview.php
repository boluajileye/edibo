<?php
session_start();
require "./config/database.php";

if(isset($_POST['vote'])){
    $candidateid = $_POST['candidateid'];
    $voter = $_POST['candidatevoter'];
    for ($i=0; $i < count($candidateid); $i++) { 
        $votee = $candidateid[$i];
        $voter_new = $voter[$i];
        $query = "SELECT * FROM candidate LEFT JOIN position ON candidate.candidate_position=position.position_id WHERE `candidate_id` = $votee ";
        $result = $dbconnect->query($query);
        foreach($result as $preview){
            $candidate = $preview['candidate_id'];
            $positon = $preview['candidate_position'];
            $query = "INSERT INTO `election`(`position_id`, `candidate_id`, `user_id`) VALUES ('$positon', '$candidate', '$voter_new')";
        $result1 = $dbconnect->query($query);
        
            
        }
    }
    if($result1){
      
      $_SESSION['message'] = "Thank You your vote has been recorded";
        header("Location: ./includes/logout.php");
    }
}
require './includes/header.php';
?>

<main class="h-full pb-16 overflow-y-auto">
<div class="container grid px-6 mx-auto">
<div class="flex flex-col m-40">
  <div class="container overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
      <div class="overflow-hidden">
        <table class="min-w-full text-center">
          <thead class="border-b bg-purple-500">
            <tr>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                Position
              </th>
              <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                Candidate
              </th>
            </tr>
          </thead>
          <?php
          
if(isset($_POST['preview'])){
    $candidateid = $_POST['candidateid'];
    $voter = $_POST['candidatevoter'];
    for ($i=0; $i < count($candidateid); $i++) {
        $votee = $candidateid[$i];
        $query = "SELECT * FROM candidate LEFT JOIN position ON candidate.candidate_position=position.position_id WHERE `candidate_id` = $votee ";
        $result = $dbconnect->query($query);
          ?>
          <tbody>
              <?php
               foreach($result as $preview){
                
          
      ?>
            <tr class="border-b bg-purple-500 border-purple-200">
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap dark:text-gray-200">
               <?php echo $preview['position_name'];?>
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap dark:text-gray-200">
              <?php echo $preview['candidate_name'];?>
              </td>
            </tr>
            <?php   }
        }
      }?>
          </tbody>
        </table>
      </div>
      <button class="mt-4 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue" onClick="history.back()">Go Back</button>
    </div>
  </div>
</div>
</div>
    </main>
<?php
require './includes/footer.php';
?>