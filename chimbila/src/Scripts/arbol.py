# -*- coding: utf-8 -*-

"""
Elaborado por Yerson Ferney Porras
ingyerfer@gmail.com
"""
from os import scandir, getcwd, chdir
import re

### Variables Globales ###
listaGeneral = []
contadorIDs=0
contadorIDAudios = 0
patronWAV = re.compile('\.(wav|WAV|Wav)$')
dicUsuarios = {
        'Angel':1,
        'Pacho':2,
        'Yerfer':3,
        'Angelica':4,
        'Juan':5,
        'Karen':6,
        'Fabian':7
    }
listaAudios = []
listaJerarquia = []
listaColeccion = []

def lsDirectorios(ruta=getcwd(), idPadre=0):
    global contadorIDs
    path = ruta
    vecTemp = [arch.name for arch in scandir(ruta) if not arch.is_file()]
    return vecTemp

def lsArchivos(ruta=getcwd(), idPadre=0):
    global contadorIDs
    path = ruta
    vecTemp = [arch.name for arch in scandir(ruta) if arch.is_file()]
    return vecTemp

def lsAll(ruta=getcwd(), idPadre=0):
    global contadorIDs
    path = ruta
    vecTemp = [arch.name for arch in scandir(ruta)]
    return vecTemp
"""
    for directorio in vecTemp:
        if(idPadre==0):
            vectorDirectorios.append([contadorIDs, directorio, None])
        else:
            vectorDirectorios.append([contadorIDs, directorio, idPadre])
        return vectorDirectorios
"""

def recorrerDirectorios(ruta='.', idPadre=0):
    global contadorIDs
    global patronWAV, contadorIDAudios
    listaLocal = []
    directoriosLocales = lsDirectorios(ruta)
    #print ("Directorios en este nivel: ", directoriosLocales)
    #print ("Tamaño: ", str(len(directoriosLocales)))
    for index, directorio in enumerate(directoriosLocales):
        contadorIDs+=1
        if (idPadre==0):
            listaGeneral.append([contadorIDs, directorio, 'null', True])
        else:
            listaGeneral.append([contadorIDs,directorio,idPadre, True])
        #print ("Estoy en...", getcwd())
        #print ("Entrando a... ", directorio)
        chdir(directorio)
        recorrerDirectorios(idPadre=contadorIDs)

    archivosLocales = lsArchivos(ruta)
    #contadorArchivos = 0
    for archivo in archivosLocales:
        if (re.search(patronWAV, archivo) is not None):
            contadorIDAudios+=1
            listaGeneral.append([contadorIDAudios,archivo, idPadre, False, getcwd()])

    #print("Regresando...")
    chdir("..")
    return

def recorrerPadre(tupla):
    lista = []
    lista.append()
    return 1

def crearTablas():
    global listaGeneral
    global dicUsuarios
    global listaAudios
    global listaJerarquia
    global listaColeccion
    idContinuacionJerarquia = 1
    idContinuacionAudios = 1
    contadorAudios = 0
    contadorJerarquia = 0
    contadorColeccion = 0
    tempRoot = ""
    patronPath = re.compile('D:.+unal-unillanos\\\\')
    patronBackslash = re.compile('\\\\')
    for index, tupla in enumerate(listaGeneral):
        if(tupla[3]): # Es un Directorio por tanto una Jerarquía
            if (tupla[2] is 'null'):
                tempRoot = tupla[1]
            listaJerarquia.append([tupla[0]+idContinuacionJerarquia-1, tupla[1], tupla[2], dicUsuarios[tempRoot]])
        else:  # Es una archivo de Audio .wav
            nombreAudio = tupla[1]
            primerPath = re.sub(patronPath, "", tupla[4])+"/"+nombreAudio
            pathAudio = re.sub(patronBackslash, "/", primerPath)
            listaAudios.append([tupla[0]+idContinuacionAudios-1, nombreAudio, tupla[1][:len(tupla[1])-4], pathAudio])
            listaColeccion.append([tupla[0]+idContinuacionAudios-1, tupla[2], dicUsuarios[tempRoot], 1])
    print ("Jerarquía: ", listaJerarquia)
    print ("Audios: ", listaAudios)
    print("Colección: ", listaColeccion)

def crearSQLs():
    import os, codecs
    tuplaAudio = ""
    tuplaJerarquia = ""
    tuplaColeccion = ""
    for i in range(0,len(listaAudios)):
        if (i < len(listaAudios) - 1):
            tuplaAudio += "\t(" + str(listaAudios[i][0]) + ", '" + listaAudios[i][1] + "', '" + listaAudios[i][2] + \
                          "', '" + listaAudios[i][3] + "'),\n"
            tuplaColeccion += "\t\t\t(" + str(listaColeccion[i][0]) + ", " + str(listaColeccion[i][1]) + ", " +\
                              str(listaColeccion[i][2])+", " + str(listaColeccion[i][3]) + "),\n"
        else:
            tuplaAudio += "\t(" + str(listaAudios[i][0]) + ", '" + listaAudios[i][1] + "', '" + listaAudios[i][2] + "', '" + \
                          listaAudios[i][3] + "');\n"
            tuplaColeccion += "\t\t\t(" + str(listaColeccion[i][0]) + ", " + str(listaColeccion[i][1]) + ", " + \
                              str(listaColeccion[i][2]) + ", " + str(listaColeccion[i][3]) + ");\n"
        if(i<len(listaJerarquia)):
            if (i < len(listaJerarquia) - 1):
                    tuplaJerarquia += "\t\t\t(" + str(listaJerarquia[i][0]) + ", '" + listaJerarquia[i][1] + \
                                      "', "+str(listaJerarquia[i][2])+", " + str(listaJerarquia[i][3]) + "),\n"
            else:
                    tuplaJerarquia += "\t\t\t(" + str(listaJerarquia[i][0]) + ", '" + listaJerarquia[i][1] + \
                                      "', "+str(listaJerarquia[i][2])+", " + str(listaJerarquia[i][3]) + ");\n"


    insertAudio = "INSERT INTO `audio` (`id`,`nombre_original`, `nombre_audio`,`ruta`) VALUES \n"
    rtaInsert = insertAudio + tuplaAudio
    print(rtaInsert)

    insertJerarquia = "INSERT INTO `jerarquia` (`id`,`nombre_coleccion`,`antecesor_id`, `usuario_id`) VALUES \n"
    rtaJerarquia = insertJerarquia + tuplaJerarquia
    print(rtaJerarquia)

    insertColeccion = "INSERT INTO `coleccion` (`audio_id`, `jerarquia_id`,`jerarquia_usuario_id`,`tipo_estado_id`) VALUES \n"
    rtaColeccion = insertColeccion + tuplaColeccion
    print(rtaColeccion)

    #Cómo en las funciones recursivas nos retornamos con chdir ahora volvemos a Audios.
    chdir("Audios")

    try:
        os.remove('insertAudios.sql')
    except OSError:
        pass

    try:
        os.remove('insertJerarquia.sql')
    except OSError:
        pass

    try:
        os.remove('insertColeccion.sql')
    except OSError:
        pass

    f1 = codecs.open('insertAudios.sql', 'w', encoding="utf-8")
    f1.write(rtaInsert)
    f1.close()

    f2 = codecs.open('insertJerarquia.sql', 'w', encoding="utf-8")
    f2.write(rtaJerarquia)
    f2.close()

    f3 = codecs.open('insertColeccion.sql', 'w', encoding="utf-8")
    f3.write(rtaColeccion)
    f3.close()


if __name__ == '__main__':
    recorrerDirectorios('.',0)
    #print ("Lista General: \n[ID, Nombre, ID_Padre, Directorio?]")
    #for tupla in listaGeneral:
    #    print(tupla)
    crearTablas()
    crearSQLs()
