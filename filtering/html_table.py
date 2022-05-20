import sys

id, c1, c2, c3, c4 = [],[],[],[],[]
with open(sys.argv[1] , "r") as f:
    # We split by the character '$' and we do not take the first character into consideration
    for l in f:
        donnee=[str(d) for d in l.split("|")]
        idi, c1i, c2i, c3i, c4i=str(donnee[0]),str(donnee[1]),str(donnee[2]),str(donnee[3]),str(donnee[4])
        id.append(idi), c1.append(c1i),c2.append(c2i),c3.append(c3i),c4.append(c4i)

# Redirect to another directory
if len(sys.argv) == 3:
    rundir = sys.argv[2]
else:
    rundir = ""

''' Conversion of the file containing the SQLite table informations to an HTML format '''
with open(rundir+"essai.html" , "w") as fileOut:
    fileOut.write('<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Document</title><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/united/bootstrap.min.css" integrity="sha384-JW3PJkbqVWtBhuV/gsuyVVt3m/ecRJjwXC3gCXlTzZZV+zIEEl6AnryAriT7GWYm" crossorigin="anonymous"></head><body><table class="table table-hover"><thead><tr><th scope="col">PDB code</th><th scope="col">Date</th><th scope="col">Method</th><th scope="col">Resolution</th></tr></thead><tbody>')  # 'head' of the output HTML file
    for i in range(len(id)) :
        fileOut.write('<tbody><tr class="table-dark"><th scope="row"> <a href="" target="_blank">'+id[i]+'</a></th><td>'+c2[i]+'</td><td>'+c3[i]+'</td><td>'+c4[i]+'</td></tr></tbody>')  # Add informations in HTML format
    fileOut.write('</table></body></html>')
