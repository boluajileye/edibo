<?php
session_start();
require "./config/database.php";
if(!isset($_SESSION['user_id'])){
    header("Location: admin/index.php");
}
if(isset($_POST['delete'])){
  $candidate_id = $_POST['candidate_id'];
  $deletecandidate = "DELETE FROM `candidate` WHERE `candidate_id`=$candidate_id";
  $delete = $dbconnect->query($deletecandidate);
  if($delete){
      $_SESSION['message'] = "Deleted successfully";
  }
}
if(isset($_POST['submit'])){
  $cimage = $_FILES['cimage']['name'];

  $folder = "./includes/assets/img/".$cimage;
  $toupload = move_uploaded_file($_FILES['cimage']['tmp_name'], $folder);


  $cname = $_POST['cname'];
  $cslogan = $_POST['cslogan'];
  $cposition = $_POST['cposition'];
  $cstatus = $_POST['cstatus'];
  $addcandidate = "INSERT INTO `candidate`(`candidate_image`, `candidate_name`, `candidate_slogan`, `candidate_position`, `candidate_status`) VALUES ('$cimage','$cname','$cslogan','$cposition','$cstatus')";
  $result = $dbconnect->query($addcandidate);
  if($result){
      $_SESSION['message'] = "Candidate Added";
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
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
      List Of Candidates
    </h2>
    <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
      <button
        @click="openModal"
        class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
      >
        Add Candidate
      </button>
    </h4>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
      <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
          <thead>
            <tr
              class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
            >
              <th class="px-4 py-3">Candidate Image</th>
              <th class="px-4 py-3">Candidate Name</th>
              <th class="px-4 py-3">Candidate Slogan</th>
              <th class="px-4 py-3">Contested Position</th>
              <th class="px-4 py-3">Actions</th>
            </tr>
          </thead>
          <tbody
            class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
          >
                  <?php
                  $getcandidate = "SELECT c.candidate_id, c.candidate_name, c.candidate_position, c.candidate_slogan, c.candidate_status, c.candidate_image, p.position_id, p.position_name FROM candidate as c LEFT JOIN position as p ON c.candidate_position = p.position_id";
                  $result = $dbconnect->query($getcandidate);
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
              <td class="px-4 py-3 text-sm"><?php echo $candidate['candidate_name'];?></td>
              <td class="px-4 py-3 text-xs">
                <?php echo $candidate['candidate_slogan'];?>
              </td>
              <td class="px-4 py-3 text-sm"><?php echo $candidate['candidate_name'];?></td>     
            </td>
              <td class="px-4 py-3">
                <div class="flex items-center space-x-4 text-sm">
                          <form method="POST">
                            <input type="hidden" name="candidate_id" value="<?php echo $candidate['candidate_id'];?>">
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
        <div
      x-show="isModalOpen"
      x-transition:enter="transition ease-out duration-150"
      x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100"
      x-transition:leave="transition ease-in duration-150"
      x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0"
      class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
    >
      <div
        x-show="isModalOpen"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 transform translate-y-1/2"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0  transform translate-y-1/2"
        @click.away="closeModal"
        @keydown.escape="closeModal"
        class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
        role="dialog"
        id="modal"
      >
        <header class="flex justify-end">
          <button
            class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700"
            aria-label="close"
            @click="closeModal"
          >
            <svg
              class="w-4 h-4"
              fill="currentColor"
              viewBox="0 0 20 20"
              role="img"
              aria-hidden="true"
            >
              <path
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"
                fill-rule="evenodd"
              ></path>
            </svg>
          </button>
        </header>
        <div class="mt-4 mb-6">
        <h4
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
              Add Candidate
            </h4>
            <div
              class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
            >
          
            <form action="" method="POST" enctype="multipart/form-data">
      <label class="block text-sm">
        <span class="text-gray-700 dark:text-gray-400">Candidate Image</span>
        <input
          type="file"
          name="cimage"
          class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
          
        />
      </label>
      <label class="block text-sm">
        <span class="text-gray-700 dark:text-gray-400">Candidate Name</span>
        <input
        type="text"
                name="cname"
          class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
          
        />
      </label>
      <label class="block text-sm">
        <span class="text-gray-700 dark:text-gray-400">Candidate Slogan</span>
        <input
                type="text"
                name="cslogan"
          class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
          
        />
      </label>
      <label class="block mt-4 text-sm">
        <span class="text-gray-700 dark:text-gray-400">
          Position Contested
        </span>
        <select
          name="cposition"
          class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
        >
                  <?php
                  $getposition = "SELECT * FROM `position`";
                  $result = $dbconnect->query($getposition);
                      foreach ($result as $position) {
                  ?>
          <option value="<?php echo $position['position_id'];?>"><?php echo $position['position_name'];?></option>
          
          <?php
                      }
                    ?>
        </select>
      </label>
      <div class="mt-4 text-sm">
        <span class="text-gray-700 dark:text-gray-400"> Candidate Status </span>
        <div class="mt-2">
          <label
            class="inline-flex items-center text-gray-600 dark:text-gray-400"
          >
            <input
              type="radio"
              class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
              name="cstatus"
              value="1"
            />
            <span class="ml-2">Qualify</span>
          </label>
          <label
            class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400"
          >
            <input
              type="radio"
              class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
              name="cstatus"
              value="0"
            />
            <span class="ml-2">DisQualify</span>
          </label>
        </div>
      </div>
                </div>
              </div> <div
          class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 sm:flex-row bg-gray-50 dark:bg-gray-800"
        >
          <button
            type="submit"
            name="submit"
            @click="closeModal"
            class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
          >
            Add
          </button>
          
          </form>
        </div>
            </div>
            
        </div>
       

  <?php
    require './includes/footer.php';
?>