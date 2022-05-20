#!/usr/bin/python3
import pandas as pd
import numpy as np
import os
import json
import plotly.figure_factory as ff
import sqlite3
import sys
import seaborn as sns
from matplotlib.pyplot import figure
import math 
import random
import chart_studio
import plotly.offline
import plotly.express as px
#chart_studio.tools.set_credentials_file(username='Lequockhang', api_key='fH1SQ9xzJzvrqpU3KK7y')

path = '/home/khangle/Downloads/RNANet'
os.chdir(path)

df = json.load(open('dict_RNANET.json'))

def plot_multi_files(input):
    ls_input = [int(i) if not(i in ['yes','no']) else i for i in input.split('+')]
    df = json.load(open('dict_RNANET.json'))
    if(ls_input[2] == 'true'):
        a = 'length'
    else:
        a = 'length_all'
    sub_name = []
    sub_eta = []
    sub_theta = []
    sub_method = []
    sub_res = []
    for p,v in enumerate(df[a]):
        if(ls_input[0] <= v and ls_input[1] >= v):
            sub_name += df['name'][p]
            sub_eta += df['eta'][p]
            sub_theta += df['theta'][p]
            sub_method += [df['method'][p]]
            sub_res += [df['resolution'][p]]
    
    return [sub_eta,sub_theta,sub_method, sub_res]

len_input = sys.argv[1]

result = plot_multi_files(len_input)

os.chdir('/var/www/html/')

#Ramachandran
x = [180/math.pi*v - 180 for p,v in enumerate(result[0]) if(math.isnan(v) == False 
                                                    and math.isnan(result[1][p]) == False)]

y = [180/math.pi*v - 180 for p,v in enumerate(result[1]) if(math.isnan(v) == False 
                                                    and math.isnan(result[0][p]) == False)]

ran_pos = random.sample(range(0, len(x)), len(x))
sub_x = []
sub_y = []
i = 0
while(sys.getsizeof(sub_y) < 524288/40):
    sub_x += [x[ran_pos[i]]]
    sub_y += [y[ran_pos[i]]]
    i+=1

colorscale = ['#7A4579', '#D56073', 'rgb(236,158,105)', (1, 1, 0.2), (0.98,0.98,0.98)]
fig = ff.create_2d_density(
    sub_x, sub_y, title = 'Ramachandran Plot', colorscale=colorscale,
    hist_color='rgb(255, 237, 222)', point_size=3)
    
plotly.offline.plot(fig, filename='output_plotly.html')

#Pie chart
Pie_method = list(set(result[2]))
Pie_method_count = [result[2].count(i) for i in Pie_method]
dict_data = {'Method': Pie_method, 'Count': Pie_method_count} 
data = pd.DataFrame(dict_data)
fig = px.pie(data, values='Count', names='Method', title='Experiment methods')
plotly.offline.plot(fig, filename='output_plotly2.html')

#Histogram
dict_data2 = {'Method': result[2] , 'Res': result[3]} 
data2 = pd.DataFrame(dict_data2)
fig = px.histogram(data2, x="Res", color="Method")
plotly.offline.plot(fig, filename='output_plotly3.html')


