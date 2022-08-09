<?php
session_start();
require "./config/database.php";
if(!isset($_SESSION['user_id'])){
    header("Location: admin/index.php");
}
if(isset($_POST['delete'])){
  $user_id = $_POST['user_id'];
  $deleteuser = "DELETE FROM `user` WHERE `user_id`=$user_id";
  $delete = $dbconnect->query($deleteuser);
  if($delete){
      $_SESSION['message'] = "Deleted successfully";
  }
}
require './includes/header.php';
?>
     <main class="h-full pb-16 overflow-y-auto">
          <div class="container grid px-6 mx-auto">
            
         <?php if(isset($_SESSION['message'])) {?>
          <div id="toast-success" class="flex items-center p-2 mt-4 w-full max-w-xs text-gray-100 bg-green-400 rounded-lg shadow dark:text-gray-400 dark:bg-green-800" role="alert">
            <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ml-3 text-sm font-normal"><?php echo $_SESSION['message']?>.</div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
            <?php
          }
          unset($_SESSION['message']);
          ?>
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              List Of Voters
            </h2>
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Voter Name</th>
                      <th class="px-4 py-3">Voter Email</th>
                      <th class="px-4 py-3">Actions</th>
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >
                  <?php
                  $getuser = "SELECT * FROM `user` ORDER BY `user_id` DESC";
                  $result = $dbconnect->query($getuser);
                      foreach ($result as $user) {
                  ?>
                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3 text-sm font-semibold">
                      <?php echo $user['firstname'];
                              echo " "; 
                              echo $user['lastname'];?>
                      </td>
                      <td class="px-4 py-3 text-xs">
                        <?php echo $user['email'];?>
                      </td>
                      <td class="px-4 py-3">
                        <div class="flex items-center space-x-4 text-sm">
                          <form method="POST">
                            <input type="hidden" name="user_id" value="<?php echo $user['user_id'];?>">
                          <button
                          type="submit" name="delete"
                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                            aria-label="Delete"
                          >
                            <svg
                              class="w-5 h-5"
                              aria-hidden="true"
                              fill="currentColor"
                              viewBox="0 0 20 20"
                            >
                              <path
                                fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd"
                              ></path>
                            </svg>
                          </button>
                      </form>
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
            </div>
          </div>
        </main>
<?php
    require './includes/footer.php';
?>