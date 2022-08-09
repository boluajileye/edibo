<?php
session_start();
require "./config/database.php";
if(!isset($_SESSION['user_id'])){
    header("Location: admin/index.php");
}
         
require './includes/header.php';
     ?>
     
    <main class="h-full pb-16 overflow-y-auto">
          <div class="container grid px-6 mx-auto">
              
  <div class="">
    <div class="bg-white rounded shadow p-30  my-30">
      <div class="px-6">
        <h3 class="text-xl text-center mt-4 font-bold">ELECTION RESULT</h3>
        <?php
        $getposition = "SELECT DISTINCT `candidate_position`, `position_name`, `position_id` FROM `candidate` LEFT JOIN position ON candidate.candidate_position=position.position_id ";
$result = $dbconnect->query($getposition);
         foreach ($result as $position) {
           $election = $position['candidate_position'];
           $pelection = $position['position_name'];
           ?>
           
        <h3 class="text-xl mt-4 font-bold">Position: <?php echo $pelection ?></h3>
           <?php
           $getresult = "SELECT e.position_id, e.candidate_id, c.candidate_name, c.candidate_image, COUNT(e.candidate_id) as voterresult FROM election AS e LEFT JOIN candidate as c ON e.candidate_id = c.candidate_id WHERE e.position_id = $election GROUP BY e.candidate_id";
           $result = $dbconnect->query($getresult);
               foreach ($result as $result) {
                ?>
              
        <div class="border w-full rounded mt-5 flex p-4 justify-between items-center flex-wrap">
        <img
                      class="object-cover h-6 w-6 rounded-full"
                      src="./includes/assets/img/<?php
                echo $result['candidate_image'];?>"
                      loading="lazy"
                    />
          <div class="w-2/3">
            <h3 class="text-lg font-medium">
               <?php echo $result['candidate_name'];?></h3>
          </div>
          <div>
            <h3 class="text-sm font-bold text-purple-800"><?php echo $result['voterresult']?></h3>
          </div>
        </div>
        <?php
    }

}
?>
  </div>
        </div>
        </main>

<?php
    require './includes/footer.php';
?>