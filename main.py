'''
Created on 15/02/2014

@author: Javier
'''

import os

os.chdir("C:\\Users\\Javier\\Documents\\urbandata\\ASB Noise Cleansing Waste Washing")


dic_cl = dict()

f = open("WCC_CleansingAntiSocialBehaviour.csv")
for i,line in enumerate(f):
    if i==0:
        continue
    
    fields  = line.split(",")
    st_name = fields[1].strip('"')
    if st_name.lower() == "not recorded":
        continue
    
    try:
        dic_cl[st_name]
        # "Vomit","HumanFouling","blood","Urine"
    except:
        dic_cl[st_name] = [0,0,0,0,0,0,0]
    if fields[6].lower().strip('"') == "yes":
        dic_cl[st_name][0] += 1
    if fields[7].lower().strip('"') == "yes":
        dic_cl[st_name][1] += 1
    if fields[8].lower().strip('"') == "yes":
        dic_cl[st_name][2] += 1
    if fields[9].lower().strip().strip('"') == "yes":
        dic_cl[st_name][3] += 1
f.close()


f = open("WCC_DogFouling.csv")
for i,line in enumerate(f):
    if i==0:
        continue
    
    fields  = line.split(",")
    st_name = fields[1].strip('"')
    if st_name.lower() == "not recorded":
        continue
    
    try:
        dic_cl[st_name]
        # "Vomit","HumanFouling","blood","Urine"
    except:
        dic_cl[st_name] = [0,0,0,0,0,0,0]
    
    if len(dic_cl[st_name]) == 4:
        dic_cl[st_name].append(0)
    dic_cl[st_name][4] += 1
f.close()



f = open("WCC_NoiseComplaintsStreetLevel.csv")
for i,line in enumerate(f):
    if i==0:
        continue
    
    fields  = line.split(",")
    st_name = fields[1].strip('"')
    if st_name.lower() == "not recorded":
        continue
    
    try:
        dic_cl[st_name]
        # "Vomit","HumanFouling","blood","Urine"
    except:
        dic_cl[st_name] = [0,0,0,0,0,0,0]
    if len(dic_cl[st_name]) < 7:
        map(dic_cl[st_name].append, [0,0])
        
    dic_cl[st_name][5] += int(fields[6].lower().strip().strip('"'))
    dic_cl[st_name][6] += int(fields[7].lower().strip().strip('"'))
f.close()




import numpy as np

N = len(dic_cl.items())
X = np.zeros((N,7))
for i, (key, val) in enumerate(dic_cl.iteritems()):
    X[i,:]=dic_cl[key]

from sklearn.manifold import LocallyLinearEmbedding
from sklearn.preprocessing import scale
lle = LocallyLinearEmbedding(n_components=3, n_neighbors=20)
print X.max(axis=0)
Y3=lle.fit_transform(scale(X))
Y3 -= Y3.min(axis=0)

print len(dic_cl.items())
lle = LocallyLinearEmbedding(n_components=1, n_neighbors=20)
Y1=lle.fit_transform(X)
Y1-=Y1.min()

o1 = open("1-d.csv","w")
o3 = open("3-d.csv","w")
for i, (key, val) in enumerate(dic_cl.iteritems()):
    o1.write("%s,%f\n" % (key, Y1[i-1]))
    o3.write("%s,%s\n" % (key, ",".join(map(str, Y3[i-1,:])) ))
o1.close()
o3.close()
import pylab
from pylab import hist, plot, show
hist(Y1)

lle = LocallyLinearEmbedding(n_components=2, max_iter=200, n_neighbors=20)
Y2=lle.fit_transform(X)
Y2 -= Y2.min(axis=0)
#plot(Y2[:,0],Y2[:,1],'.')
show()