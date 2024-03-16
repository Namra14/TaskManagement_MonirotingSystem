<?php

      //count every student suitable to wmad specialization
      $count_wmad = "SELECT COUNT(*) as count FROM `students_acc` WHERE specialization = 'WMAD'";
      $result = mysqli_query($conn, $count_wmad);
      $row = mysqli_fetch_assoc($result);
      $wmad = $row['count'];

      //count every student suitable to smp specialization
      $count_wmad = "SELECT COUNT(*) as count FROM `students_acc` WHERE specialization = 'SMP'";
      $result = mysqli_query($conn, $count_wmad);
      $row = mysqli_fetch_assoc($result);
      $smp = $row['count'];

      //count every student suitable to amg specialization
      $count_wmad = "SELECT COUNT(*) as count FROM `students_acc` WHERE specialization = 'AMG'";
      $result = mysqli_query($conn, $count_wmad);
      $row = mysqli_fetch_assoc($result);
      $amg = $row['count'];

      //count every student suitable to smp & amg specialization
      $count_wmad = "SELECT COUNT(*) as count FROM `students_acc` WHERE specialization = 'SMP/AMG'";
      $result = mysqli_query($conn, $count_wmad);
      $row = mysqli_fetch_assoc($result);
      $smp_amg = $row['count'];

      //count every student suitable to amg & wmad specialization
      $count_wmad = "SELECT COUNT(*) as count FROM `students_acc` WHERE specialization = 'AMG/WMAD'";
      $result = mysqli_query($conn, $count_wmad);
      $row = mysqli_fetch_assoc($result);
      $amg_wmad = $row['count'];

      //count every student suitable to smp & wmad specialization
      $count_wmad = "SELECT COUNT(*) as count FROM `students_acc` WHERE specialization = 'WMAD/SMP'";
      $result = mysqli_query($conn, $count_wmad);
      $row = mysqli_fetch_assoc($result);
      $wmad_smp = $row['count'];

      //count every student suitable to all specialization
      $count_wmad = "SELECT COUNT(*) as count FROM `students_acc` WHERE specialization = 'ALL'";
      $result = mysqli_query($conn, $count_wmad);
      $row = mysqli_fetch_assoc($result);
      $all = $row['count'];

      $count_specializations = array();
      $count_specializations[] = $wmad;
      $count_specializations[] = $smp;
      $count_specializations[] = $amg;
      $count_specializations[] = $smp_amg;
      $count_specializations[] = $amg_wmad;
      $count_specializations[] = $wmad_smp;
      $count_specializations[] = $all;

      foreach($query as $data){
        $specialization = $data['specialization'];
      }



      //Count all the grade based recommendation
      $gbased_wmad = "SELECT COUNT(*) as count FROM `students_acc` WHERE grade_based = 'WMAD'";
      $result = mysqli_query($conn, $gbased_wmad);
      $row = mysqli_fetch_assoc($result);
      $g_wmad = $row['count'];

      $gbased_amg = "SELECT COUNT(*) as count FROM `students_acc` WHERE grade_based = 'AMG'";
      $result = mysqli_query($conn, $gbased_amg);
      $row = mysqli_fetch_assoc($result);
      $g_amg = $row['count'];

      $gbased_smp = "SELECT COUNT(*) as count FROM `students_acc` WHERE grade_based = 'SMP'";
      $result = mysqli_query($conn, $gbased_smp);
      $row = mysqli_fetch_assoc($result);
      $g_smp = $row['count'];

      $count_grade_based = array();
      $count_grade_based[] = $g_wmad;
      $count_grade_based[] = $g_amg;
      $count_grade_based[] = $g_smp;


      //Count all the preference based recommendation
      $pbased_wmad = "SELECT COUNT(*) as count FROM `students_acc` WHERE preference_based = 'WMAD'";
      $result = mysqli_query($conn, $pbased_wmad);
      $row = mysqli_fetch_assoc($result);
      $pb_wmad = $row['count'];

      $pbased_amg = "SELECT COUNT(*) as count FROM `students_acc` WHERE preference_based = 'AMG'";
      $result = mysqli_query($conn, $pbased_amg);
      $row = mysqli_fetch_assoc($result);
      $pb_amg = $row['count'];

      $pbased_smp = "SELECT COUNT(*) as count FROM `students_acc` WHERE preference_based = 'SMP'";
      $result = mysqli_query($conn, $pbased_smp);
      $row = mysqli_fetch_assoc($result);
      $pb_smp = $row['count'];

      $count_p_based = array();
      $count_p_based[] = $pb_wmad;
      $count_p_based[] = $pb_amg;
      $count_p_based[] = $pb_smp;


      //Count all the Student Choice
      $schoice_wmad = "SELECT COUNT(*) as count FROM `students_acc` WHERE student_choice = 'WMAD'";
      $result = mysqli_query($conn, $schoice_wmad);
      $row = mysqli_fetch_assoc($result);
      $sc_wmad = $row['count'];

      $schoice_amg = "SELECT COUNT(*) as count FROM `students_acc` WHERE student_choice = 'AMG'";
      $result = mysqli_query($conn, $schoice_amg);
      $row = mysqli_fetch_assoc($result);
      $sc_amg = $row['count'];

      $schoice_smp = "SELECT COUNT(*) as count FROM `students_acc` WHERE student_choice = 'SMP'";
      $result = mysqli_query($conn, $schoice_smp);
      $row = mysqli_fetch_assoc($result);
      $sc_smp = $row['count'];

      $count_schoice = array();
      $count_schoice[] = $sc_wmad;
      $count_schoice[] = $sc_amg;
      $count_schoice[] = $sc_smp;
?>