import pandas as pd
import numpy as np
import os
import json
import plotly
import plotly.figure_factory as ff
import sqlite3
import sys
import seaborn as sns
from matplotlib.pyplot import figure
import math 
import random
import chart_studio
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
    for p,v in enumerate(df[a]):
        if(ls_input[0] <= v and ls_input[1] >= v):
            sub_name += df['name'][p]
            sub_eta += df['eta'][p]
            sub_theta += df['theta'][p]
        
    return [sub_eta,sub_theta]

len_input = sys.argv[1]

result = plot_multi_files(len_input)

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
    
import chart_studio.plotly as py
import plotly.figure_factory as ff

colorscale = ['#7A4579', '#D56073', 'rgb(236,158,105)', (1, 1, 0.2), (0.98,0.98,0.98)]

fig = ff.create_2d_density(
    sub_x, sub_y, colorscale=colorscale,
    hist_color='rgb(255, 237, 222)', point_size=3
)
import plotly.offline
os.chdir('/var/www/html/')
plotly.offline.plot(fig, filename='output_plotly.html')
