from pandas import read_csv, concat

folder = ''

def create_cleansing_anti_social_behaviour_data():

    # parse, merge clean, compute average street latitude and longitude from anti social behaviour events
    asb = read_csv(folder + 'WCC_CleansingAntiSocialBehaviour.csv')
    dog_fouling = read_csv(folder + 'WCC_DogFouling.csv')
    together = concat([asb[['StreetName', 'lat', 'long']], dog_fouling[['StreetName', 'lat', 'long']]])
    together = together[~(together.StreetName == 'Not Recorded')].drop_duplicates()
    averaged = together.groupby('StreetName', as_index=False).mean()

    # parses, cleans Jackie Steiniz's data
    cw = read_csv(folder +'cwdata.csv')
    cw = cw.applymap(lambda c: str(c).upper() if type(c) != 'int64' else c)
    cw = cw.drop_duplicates()

    # merges both and outputs to json
    final = cw.merge(averaged, left_on='lcstreet', right_on='StreetName').drop('StreetName', axis=1)
    final.to_json(folder +'cw-json.json', 'records')


def create_combined_cleansing_anti_social_behaviour_data():

    # parse, merge clean, compute average street latitude and longitude from anti social behaviour events
    asb = read_csv(folder + 'WCC_CleansingAntiSocialBehaviour.csv')
    dog_fouling = read_csv(folder + 'WCC_DogFouling.csv')
    together = concat([asb[['StreetName', 'lat', 'long']], dog_fouling[['StreetName', 'lat', 'long']]])
    together = together[~(together.StreetName == 'Not Recorded')].drop_duplicates()
    averaged = together.groupby('StreetName', as_index=False).mean()

    # parses, cleans Javier Arriero's data
    lle = read_csv(folder +'1-d.csv',header=None, names=['StreetName','value'])
    lle = lle.drop_duplicates()

    # merges both and outputs to json
    final = lle.merge(averaged, on='StreetName')
    final.to_json(folder +'1-d-json.json', 'records')

if __name__ == '__main__':

    create_cleansing_anti_social_behaviour_data()
    create_combined_cleansing_anti_social_behaviour_data()

