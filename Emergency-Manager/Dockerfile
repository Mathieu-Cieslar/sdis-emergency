# Étape 1 : Construction
FROM maven as build


WORKDIR /app
COPY pom.xml ./
COPY src ./src

# Compile le projet sans démarrer le serveur
RUN mvn package -DskipTests

# Étape 2 : Exécution
FROM openjdk:17
WORKDIR /app

# Copier l'application compilée depuis l'étape de construction
COPY --from=build /app/target/quarkus-app/quarkus-run.jar app.jar

# Expose le port du serveur
EXPOSE 8080

# Commande pour exécuter le serveur lors du lancement du conteneur
CMD ["java", "-jar", "app.jar"]
