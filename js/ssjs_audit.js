/* A License Object a person may hold*/
function license(name, date, number){
    this.name = name;
    this.date = date;
    this.number = number;
    this.isExpired = false;
    this.pointIntime = new Date();
};

/*License Getters*/
license.prototype.getName = function(){
    return this.name;
}

license.prototype.getDate = function(){
    return this.date;
}

license.prototype.getNumber = function(){
    return this.number;
}

license.prototype.isExpired = function(dateToCompare){
    /*Check the this.date and see if it is before or on dateToCompare*/
    return false;
}

/*License Setters*/
license.prototype.setName = function(name){
    this.name = name;
}

license.prototype.setDate = function(date){
    this.date = date;
}

license.prototype.setNumber = function(number){
    this.number = number;
}

license.prototype.isExpired = function(){
    return this.isExpired();
}

license.prototype.checkExpired = function(dateInTime){
    if(this.date <= dateInTime){
        this.isExpired = true;
    }else{
        this.isExpired = false;
    }
    return this.isExpired;
}

/* A Person Object*/
function person(id, firstName, lastName, jobRole){
    this.id = id;
    this.jobRole = jobRole;
    this.firstName = firstName;
    this.lastName = lastName;
    this.license = [];
};

/*Person Getters*/
person.prototype.getId = function(){
    return this.id;
}
person.prototype.getFirstName = function(){
    return this.firstName;
}
person.prototype.lastName = function(){
    return this.lastName;
}
person.prototype.getLicense = function(name){
    /*Search license array for a match and return the license object*/
}
person.prototype.addLicense = function(license){
    /* adding a license to a person object */
    this.license.push(license);
};
/*Person Setters*/
person.prototype.setLicense = function(license){
    /*make sure passed in value is an array, if not, create array and assign to index zero*/
    this.license = license;
}
person.prototype.setFirstName = function(firstName){
    this.firstName = firstName;
}
person.prototype.setLastName = function(lastName){
    this.lastName = lastName;
}
person.prototype.setId = function(id){
    this.id = id;
}

function audit(){

}

audit.prototype.create = function(){
    this.audit.id = "";
    this.people = [];
}

audit.prototype.loadFromDocument = function(doc){
    this.audit.id = "";
}

audit.prototype.addPerson = function(person){
    this.people.push(person);
}

audit.prototype.setPeople = function(people){
    this.people = people;
}

audit.prototype.getPeople = function(){
    return this.people;
}