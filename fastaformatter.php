<?php
  
  
$fastasequence = 
">gi|532319|pir|TVFV2E|TVFV2E envelope protein
ELRLRYCAPAGFALLKCNDADYDGFKTNCSNVSVVHCTNLMNTTVTTGLLLNGSYSENRT
QIWQKHRTSNDSALILLNKHYNLTVTCKRPGNKTVLPVTIMAGLVFHSQKYNLRLRQAWC
HFPSNWKGAWKEVKEEIVNLPKERYRGTNDPKRIFFQRQWGDPETANLWFNCHGEFFYCK
MDWFLNYLNNLTVDADHNECKNTSGTKSGNKRAPGPCVQRTYVACHIRSVIIWLETISKK
TYAPPREGHLECTSTVTGMTVELNYIPKNRTNVTLSPQIESIWAAELDRYKLVEITPIGF
APTEVRRYTGGHERQKRVPFVXXXXXXXXXXXXXXXXXXXXXXVQSQHLLAGILQQQKNL
LAAVEAQQQMLKLTIWGVK";
  
  $newparagraph = "\n\n";
  $formattedsequence = formatFastaSequence( $fastasequence, 6, 10 );

  echo "<pre>";
  echo $fastasequence;
  echo $newparagraph;
  echo $formattedsequence;
  echo "</pre>";
  
  
    
  function formatFastaSequence( $rawfastasequence, $no_of_columns, $aminoacids_per_column ) {

    $sequencelines = explode( "\n", $rawfastasequence );
    $sequence_in_one_line = '';

    foreach( $sequencelines as $line ) {
      if ( substr( $line, 0, 1 ) != '>' ) {      
        $sequence_in_one_line .= $line;
      }
    }

    $sequence_chunks = str_split( $sequence_in_one_line, $aminoacids_per_column );
    
    $output_lines = array();
    $remaining_chunks = count($sequence_chunks);
    echo "\nRem chunks: $remaining_chunks\n";
    
    $i = 0;
    while( $remaining_chunks > 0 ) {
      $output_lines[$i] = '';
      $current_aa = ( ( $i * $no_of_columns * $aminoacids_per_column) + 1 );
      $current_aa_formatted = sprintf("%5d", $current_aa);
      $output_lines[$i] .= $current_aa_formatted . ' ';
      for( $j = 0; $j < $no_of_columns; $j++ ) {
        $current_chunk = ( $i * $no_of_columns ) + $j;
        if ( $sequence_chunks[ $current_chunk ] != '' ) {
          $output_lines[$i] .= $sequence_chunks[ $current_chunk ] . ' ';
        }
        $remaining_chunks--;
        // echo "\nRem chunks: $remaining_chunks\n";
      }
      $i++;
    }
    
    $result = '';
    foreach( $output_lines as $line ) {
      $result .= "$line\n";
    }
    
    return $result;
  }
  
  
