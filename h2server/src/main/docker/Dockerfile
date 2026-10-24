FROM eclipse-temurin:25-jre-alpine
ADD h2.jar /h2.jar
#ADD h2-2.5.252.jar /h2.jar

RUN mkdir /data
VOLUME [ "/data" ]
# TODO - "Pre-" Create the database
# Database "/data/h2.test" not found, either pre-create it or allow remote
# database creation (not recommended in secure environments) [90149-200] 90149/90149 (Help)
# https://h2database.com/javadoc/org/h2/api/ErrorCode.html#c90149

# The -ifNotExists switch is not applicable to the console.
# http://www.h2database.com/html/tutorial.html?highlight=ifNotExists&search=ifnotexists#firstFound

#RUN "java -cp h2.jar org.h2.tools.Shell -url jdbc:h2:~/data/h2.test -user sa -password test"
#ENV AUTO_SERVER=TRUE
WORKDIR /
#ENTRYPOINT [ "java", "-cp", "h2.jar", "org.h2.tools.Shell", "-url", "jdbc:h2:~/data/h2.test", "-user","sa","-password","test"  ]
#ENTRYPOINT [ "java", "-cp", "h2.jar", "org.h2.tools.Server", "-pg", "-pgAllowOthers", "-baseDir", "/data"  ]

EXPOSE 9092

#CMD [ "org.h2.tools.Server", "-tpc", "-tcpAllowOthers", "-baseDir", "/data" ]
ENTRYPOINT [ "java", "-cp", "h2.jar", "org.h2.tools.Server", "-tcp", "-tcpAllowOthers", "-baseDir", "/data"  ]
