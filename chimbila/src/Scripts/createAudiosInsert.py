import csv, re, os

##
##  Author: Yerfer Porras, ingyerfer@gmail.com.
##
##  NOTA: Este script reconoce todas las jerarquias que se llamen diferente
##      Por ahora, todas las jerarquias de cualquier usuario deben ser diferentes.
##

def leer():

    var = open('collectionList.csv', 'r', newline='', encoding='utf-8')
    tamVar = len(var.readlines())
    var.close()
    dicJerarquia = {}
    listJerarquia = []
    dicUsuarios = {
        'Angel':1,
        'Pacho':2,
        'Yerfer':3,
        'Angelica':4,
        'Juan':5,
        'Karen':6,
        'Fabian':7
    }
    contadorJerarquia = 0
    contAudiosID = 0
    tuplaAudio = ""
    tuplaJerarquia = ""
    tuplaColeccion = ""
    vectorAnterior = []
    vectorAntIndex = []
    bandera = False
    with open('collectionList.csv', newline='', encoding='utf-8') as csvfile:
        spamreader = csv.reader(csvfile, delimiter=',', quotechar='|')
        for index, rutaVector in enumerate(spamreader):
            rutaParcial = '/'.join(rutaVector)
            rutaAudio = "chimbila/"+rutaParcial
            nombreAudio = re.sub(re.compile('.wav$'),"",rutaVector[len(rutaVector)-1])
            #print(str(index)+": ")
            contAudiosID += 1
            if (index < tamVar-1):
                tuplaAudio += "\t(" +str(contAudiosID)+", '"+nombreAudio + "', '" + nombreAudio + "', '" + rutaAudio + "'),\n"
            else:
                tuplaAudio += "\t(" +str(contAudiosID)+", '"+nombreAudio + "', '" + nombreAudio + "', '" + rutaAudio + "');\n"
            vectorTemp = []
            vectorTempIndex = []
            if(index != 0):
                vectorAnterior = vectorTemp[:]
                vectorAntIndex = vectorTempIndex[:]
            for index2, dato in enumerate(rutaVector[1:(len(rutaVector)-1)]):
                try:
                    vectorTemp.append(dato)
                    vectorTempIndex.append(contadorJerarquia)
                    temp = listJerarquia[index2]
                    if(dato != vectorAnterior[index2]):
                        # Existe el índice pero no es el mismo valor del vector.
                        listJerarquia.append(dato)
                        contadorJerarquia+=1
                        if (index2 < tamVar - 1):
                            if (index2 == 0):
                                tuplaJerarquia += "\t\t\t(" + str(contadorJerarquia) + ", '" + rutaVector[
                                    1] + "', null, " + str(
                                    dicUsuarios[rutaVector[1]]) + "),\n"
                            else:
                                tuplaJerarquia += "\t\t\t(" + str(contadorJerarquia) + ", '" + listJerarquia[
                                    contadorJerarquia - 1] + "', " \
                                                  + str(vectorAntIndex[index2 - 1]) + ", " + str(
                                    dicUsuarios[rutaVector[1]]) + "),\n"
                        else:
                            if (index2 == 0):
                                tuplaJerarquia += "\t\t\t(" + str(contadorJerarquia) + ", '" + rutaVector[
                                    1] + "', null, " + str(
                                    dicUsuarios[rutaVector[1]]) + ");\n"
                            else:
                                tuplaJerarquia += "\t\t\t(" + str(contadorJerarquia) + ", '" + listJerarquia[
                                    contadorJerarquia - 1] + "', " \
                                                  + str(vectorAntIndex[index2 - 1]) + ", " + str(
                                    dicUsuarios[rutaVector[1]]) + ");\n"
                    #else:
                        # Existe el índice y además es el mismo valor del vector en esa posición.
                except IndexError:
                    # no existe el índice
                    listJerarquia.append(dato)
                    contadorJerarquia += 1
                    vectorTempIndex.append(contadorJerarquia)
                    if (index2 < tamVar - 1):
                        if (index2 == 0):
                            tuplaJerarquia += "\t\t\t(" + str(contadorJerarquia) + ", '" + rutaVector[1] + "', null, " + str(
                                dicUsuarios[rutaVector[1]]) + "),\n"
                        else:
                            tuplaJerarquia += "\t\t\t(" + str(contadorJerarquia) + ", '" + listJerarquia[contadorJerarquia-1] + "', " \
                                              + str(vectorAntIndex[index2-1]) + ", " + str(dicUsuarios[rutaVector[1]]) + "),\n"
                    else:
                        if (index2 == 0):
                            tuplaJerarquia += "\t\t\t(" + str(contadorJerarquia) + ", '" + rutaVector[1] + "', null, " + str(
                                dicUsuarios[rutaVector[1]]) + ");\n"
                        else:
                            tuplaJerarquia += "\t\t\t(" + str(contadorJerarquia) + ", '" + listJerarquia[contadorJerarquia-1] + "', " \
                                              + str(vectorAntIndex[index2-1]) + ", " + str(dicUsuarios[rutaVector[1]]) + ");\n"

                """
                if (dato not in dicJerarquia):
                    dicJerarquia[dato]= contadorJerarquia
                    contadorJerarquia+=1
                    if (index2 < tamVar - 1):
                        if(index2 == 0):
                            tuplaJerarquia += "\t\t\t(" + str(dicJerarquia[dato]) + ", '" + dato+"', null, "+str(dicUsuarios[rutaVector[1]])+"),\n"
                        else:
                            tuplaJerarquia += "\t\t\t(" + str(dicJerarquia[dato]) + ", '" + dato+"', "+str(dicJerarquia[rutaVector[index2]])\
                                              +", "+str(dicUsuarios[rutaVector[1]])+"),\n"
                    else:
                        if (index2 == 0):
                            tuplaJerarquia += "\t\t\t(" + str(dicJerarquia[dato]) + ", '" + dato + "', null, " + str(dicUsuarios[rutaVector[1]]) + ");\n"
                        else:
                            tuplaJerarquia += "\t\t\t(" + str(dicJerarquia[dato]) + ", '" + dato + "', " + str(dicJerarquia[rutaVector[index2]])\
                                              + ", " + str(dicUsuarios[rutaVector[1]]) + ");\n"
                #else:
                #    print ("DATO: ")
                #    print (str(dato))
                
                """
            #print ("Lista: ")
            #print (listJerarquia)
            #print ("-----------------------------\n----------------------")
            #if (index < tamVar-1):
            #    tuplaColeccion += "\t\t\t(" +str(index+1)+", "+str(dicJerarquia[rutaVector[len(rutaVector)-2]]) + ", " + str(dicUsuarios[rutaVector[1]]) + ", 1),\n"
            #else:
                #tuplaColeccion += "\t\t\t(" +str(contAudiosID)+", "+str(dicJerarquia[rutaVector[len(rutaVector)-2]]) + ", " + str(dicUsuarios[rutaVector[1]]) + ", 1);\n"


    insertAudio = "INSERT INTO `audio` (`id`,`nombre_original`, `nombre_audio`,`ruta`) VALUES \n"
    rtaInsert = insertAudio+tuplaAudio
    print (rtaInsert)
    
    insertJerarquia = "INSERT INTO `jerarquia` (`id`,`nombre_coleccion`,`antecesor_id`, `usuario_id`) VALUES \n"
    rtaJerarquia = insertJerarquia + tuplaJerarquia
    print (rtaJerarquia)
    """
    insertColeccion = "INSERT INTO `coleccion` (`audio_id`, `jerarquia_id`,`jerarquia_usuario_id`,`tipo_estado_id`) VALUES \n"
    rtaColeccion = insertColeccion + tuplaColeccion
    #print(rtaColeccion)

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

    f1 = open('insertAudios.sql', 'w')
    f1.write(rtaInsert)
    f1.close()

    f2 = open('insertJerarquia.sql', 'w')
    f2.write(rtaJerarquia)
    f2.close()

    f3 = open('insertColeccion.sql', 'w')
    f3.write(rtaColeccion)
    f3.close()

"""
leer()