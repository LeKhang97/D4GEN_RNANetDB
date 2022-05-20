import pandas as pd
import numpy as np
import os
import math 
import json
import seaborn as sns
import matplotlib.pyplot as plt
import sqlite3
import sys
from matplotlib.pyplot import figure


path = '/home/khangle/Downloads/RNANet'
os.chdir(path)

df = json.load(open('dict_RNANET.json'))

def plot_multi_files(input):
    ls_input = [int(i) if not(i in ['yes','no']) else i for i in input.split('+')]
    df = json.load(open('dict_RNANET.json'))
    if(ls_input[2] == 'yes'):
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
figure(figsize=(8, 8), dpi=80)

plt.subplots_adjust(wspace= 0.3, hspace= 0.3)

plt.xlabel("Eta")
plt.ylabel("Theta")
plt.title("Ramachandran plot")
plt.axhline(y=0, color='r', linestyle='--', alpha = 0.6)
plt.axvline(x=0, color='r', linestyle='--', alpha = 0.6)
plt.xlim(-180,180)
plt.ylim(-180,180)
sns.kdeplot(x, y, cmap="Blues", shade=True)
#plt.show()

os.chdir('/var/www/html/')
plt.savefig('plot.png')
