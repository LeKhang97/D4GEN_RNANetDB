#This files here is to visualize the 2D from given pdb_id and chain_name

  *** First you need to have the .json file, RNAVienna and forna ***
- The .json file can be access via: https://drive.google.com/file/d/1ZYEkASg5wjXhZk3yRmKfjoDVMGwjB-ZP/view?usp=sharing
- To install RNAVienna, please follow this instruction: https://www.tbi.univie.ac.at/RNA/#download 
- All of FORNA files which will be used can be download in <htdocs> folder in this directory
  
There are 2 .php files and 1 .py file:
  ### - input_pdb_to_2d.php: 
Take the pdb id and chain id as the inputs. Then it will transfer these inputs to output_pdb_2d.php file
  
  ### - output_pdb_to_2d.php:
Take the inputs from input file and then: first run the .py file to get the out_file which containing the sequence of your concerned pdb id, then execute RNAfold to get the 2nd structure, and display the visualization by forna.
  
  ### - 2d_from_pdb.py:
Take the pdb_id and chain_id as the input. You can excecute it directly on terminal through this command:
  `python3 2d_from_pdb.py <pdb-id>_<pdb-chain>`
  
  
