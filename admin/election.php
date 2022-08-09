<?php
session_start();
require "./config/database.php";
if(!isset($_SESSION['user_id'])){
    header("Location: admin/index.php");
}
$user_id = $_SESSION['user_id'];

require './includes/header.php';
?>
    <main class="h-full pb-16 overflow-y-auto">
          <div class="container grid px-6 mx-auto">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              List Of Elections
            </h2>
            <h4
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
            Kindly Vote at least one position before you proceed
            </h4>
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <?php
             $getelection = "SELECT DISTINCT `candidate_position`, `position_name`, `position_id` FROM `candidate` LEFT JOIN position ON candidate.candidate_position=position.position_id ";
             $result = $dbconnect->query($getelection);
                      foreach ($result as $position) {
                        $election = $position['candidate_position'];
                  ?>
                <p class="text-lg text-center font-semibold mb-3 dark:text-gray-200"><?php echo $position['position_name'];?> </p>
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Candidate Image</th>
                      <th class="px-4 py-3">Candidate Name</th>
                      <th class="px-4 py-3">Cast Your Vote</th>
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >
                 
                <?php
                  $getresult = "SELECT * FROM `candidate` WHERE `candidate_position` = $election";
                  $result = $dbconnect->query($getresult);
                      foreach ($result as $candidate) {
                  ?>
                    <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">
                <div class="flex items-center text-sm">
                  <div
                    class="relative w-8 h-8 mr-3 rounded-full md:block"
                  >
                    <img
                      class="object-cover w-full h-full rounded-full"
                      src="./includes/assets/img/<?php echo $candidate['candidate_image'];?>"
                      alt="<?php echo $candidate['candidate_name'];?>"
                      loading="lazy"
                    />
                    <div
                      class="absolute inset-0 rounded-full shadow-inner"
                      aria-hidden="true"
                    ></div>
                  </div>
                </div>
              </td>
                      <td class="px-4 py-3 text-xs">
                        <span
                          class="px-2 py-1 font-semibold dark:bg-gray-700 dark:text-gray-100"
                        >
                        <?php echo $candidate['candidate_name'];?>
                        </span>
                      </td>
                      <td class="px-4 py-3">
                        <form method="POST" action="preview.php">
                        <div class="flex items-center space-x-4 text-sm">
                          <input type="checkbox" name="candidateid[]" value="<?php echo $candidate['candidate_id'];?>" class="w-8 h-8 rounded">
                          <input type="hidden" name="candidatevoter[]" value="<?php echo $user_id;?>">
                        </div>
                      </td>
                    </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
              <div
                class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"
              >
              </div>
              
          <?php
                      }
                    ?>
                    <div class="flex flex-col flex-wrap mb-4 space-y-4 md:flex-row md:items-end md:space-x-4">
                    <input type="submit" name="preview" value="Preview" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                <input type="submit" value="Submit Vote"  name="vote" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                </form>
                    </div> 
            </div> 
          </div>
        </main>

<?php
    require './includes/footer.php';
?>