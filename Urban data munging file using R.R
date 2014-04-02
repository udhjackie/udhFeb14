## R program for data munging the urban data to create one csv file with 
## the number of incidents of each type per street


#Load libraries which will be required 
library(plyr) ' for sorting'
library(stringi) # for capitalising Street names

#  setwd("~/yourdir/yourdir")  #set working directory as appropriate

#Read in each of the data file for each issue
d1<-read.csv("works.csv")
d2<-read.csv("dogs.csv")
d3<-read.csv("washing.csv")
d4<-read.csv("graffiti.csv")
d5<-read.csv("waste.csv")
d6<-read.csv("totalnoise.csv")
d7<-read.csv("daynoise.csv")
d8<-read.csv("nightnoise.csv")

#Remove unnecessary columns
d1<-subset(d1,select=-streetname)
d2<-subset(d2,select=-streetname)
d3<-subset(d3,select=-streetname)
d4<-subset(d4,select=-streetname)
d5<-subset(d5,select=-streetname)
d6<-subset(d6,select=-streetname)
d7<-subset(d7,select=-streetname)
d8<-subset(d8,select=-streetname)

#Merge datasets 1 and 2, then 3, then 4 etc.
dmain<-d1
dmain<-merge(dmain,d2, by="lcstreet", all=TRUE)
dmain<-merge(dmain,d3, by="lcstreet", all=TRUE)
dmain<-merge(dmain,d4, by="lcstreet", all=TRUE)
dmain<-merge(dmain,d5, by="lcstreet", all=TRUE)
dmain<-merge(dmain,d6, by="lcstreet", all=TRUE)
dmain<-merge(dmain,d7, by="lcstreet", all=TRUE)
dmain<-merge(dmain,d8, by="lcstreet", all=TRUE)

#Replace NAs with zeros where necessary
dmain$works[is.na(dmain$works)]<-0
dmain$dogs[is.na(dmain$dogs)]<-0
dmain$washing[is.na(dmain$washing)]<-0
dmain$graffiti[is.na(dmain$graffiti)]<-0
dmain$waste[is.na(dmain$waste)]<-0
dmain$totalnoise[is.na(dmain$totalnoise)]<-0
dmain$daynoise[is.na(dmain$daynoise)]<-0
dmain$daynoise[is.na(dmain$daynoise)]<-0

#Add dummy column for use in ddply ranking
dmain$dummy<-1

dmain<-ddply(dmain, .(dummy), mutate,
  worksrank = rank(-works, ties.method = "first"),
  dogsrank = rank(-dogs, ties.method = "first"),
  washingrank = rank(-washing, ties.method = "first"),
  graffittrank = rank(-graffiti, ties.method = "first"),
  wasterank = rank(-waste, ties.method = "first"),
  totalnoiserank = rank(-totalnoise, ties.method = "first"),
  daynoiserank = rank(-daynoise, ties.method = "first"),
  nightnoiserank = rank(-nightnoise, ties.method = "first"))

#Remove dummy column
dmain<-subset(dmain,select=-dummy)

#capitalise street names
dmain$lcstreet<-stri_trans_totitle(dmain$lcstreet)

#write a new csv file with the merged data and rankings
write.csv(dmain, "cwrankdata3.csv", row.names=FALSE)
