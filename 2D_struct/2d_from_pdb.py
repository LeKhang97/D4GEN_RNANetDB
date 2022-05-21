import numpy as np
import os
import sys
import json

df = json.load(open('dict_RNANET.json'))

input = sys.argv[1]

var = input.split('_')

st = ''
for p,v in enumerate(df['name']):
    if(var[0] == v.split('_')[0] and var[1] == v.split('_')[2]):
        st = st.join([i for i in df['seq'][p] if i in ['A','U','G','C']])
        break

with open('out_file','w') as outfile:
	outfile.write(st)
