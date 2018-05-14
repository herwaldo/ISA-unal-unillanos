import os, csv, re

##Fuente: https://gist.github.com/igniteflow/1632798.
def remove_none_elements_from_list(list):
    return [e for e in list if e != None]

##Author: Kran Cruz, thekran95@gmail.com.
def list_files(startpath):
    print ("startpath: "+startpath)
    v=[None]*20
    try:
        os.remove('collectionList.csv')
    except OSError:
        pass
    for root, dirs, files in os.walk(startpath):
        level = root.replace(startpath, '').count(os.sep)
        v[level]=os.path.basename(root)
        for f in files:
            if f != os.path.basename(__file__) and f != 'collectionList.csv' and f != 'folderTreeReversed.py' and f != 'createAudiosInsert.py' \
                    and f != 'insertAudios.sql' and f != 'insertJerarquia.sql' and f != 'insertColeccion.sql':
                for i in range(len(v)-(level+1)):
                    v[i+(level+1)]=None
                v[level+1]=f
                vector = remove_none_elements_from_list(v)
                with open('collectionList.csv', 'a', newline='', encoding='utf-8') as csvfile:
                    spamwriter = csv.writer(csvfile, quotechar = ',', quoting=csv.QUOTE_MINIMAL)
                    spamwriter.writerow(vector)
                #print('{}{}'.format(subindent, f))


cwd = os.getcwd()
list_files(cwd)