import sys
import plotly
import plotly.express as px

file_in = open(sys.argv[1], "r")

text1 = next(file_in).strip("\n").split(",")
text2 = next(file_in).strip("\n").split(",")

list1 = []
list2 = []

for i in range(len(text1)):
    list1.append(int(text1[i]))
    list2.append(int(text2[i]))

fig = px.bar(x=list1, y=list2, labels={'x':'Resolution', 'y':'Number of PDB'})
fig.show()

plotly.offline.plot(fig, filename='/home/d4gen/Desktop/RNANet/resolution_stat.html')
