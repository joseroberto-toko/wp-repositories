const token = "YOUR TOKEN";

// HEADER FOR THE API
const headers = {
  Authorization: `bearer ${token}`,
  "Content-type": "application/json",
};

// FETCH DATA AS THE WEBPAGE LOADS
// window.onload = () => fetchData();

function getRepositories() {
  let val = document.querySelector("#filter").value;
  const wpr_listing = document.querySelector("#wpr_listing");

  wpr_listing.innerHTML = "Carregando ...";

  let query = `{
    search(query: "${val}", type: REPOSITORY, first: 10) {
      edges {
        node {
          ... on Repository {
            id
            name
            description
            forkCount
            pushedAt
            url
            isPrivate
            owner {
              login
            }
            stargazers {
              totalCount
            }
            licenseInfo {
              name
            }
            primaryLanguage {
              name
              color
            }
          }
        }
      }
    }
  }`;
  if (val.length <= 3 && val.length > 0) {
    wpr_listing.innerHTML = "Carregando...";
  } else {
    wpr_listing.innerHTML = "";
  }

  if (val.length > 3) {
    wpr_listing.innerHTML = `<h3>Repositórios</h3>
    <div class="user-repositories-list">
      <ul class="repositories-list-identifier"></ul>
    </div>`;
    fetchData(JSON.stringify({ query }));
  }
}

function getRepositories() {
  let val = document.querySelector("#filter").value;
  const wpr_listing = document.querySelector("#wpr_listing");

  wpr_listing.innerHTML = "Carregando ...";

  let query = `{
    search(query: "${val}", type: REPOSITORY, first: 10) {
      edges {
        node {
          ... on Repository {
            id
            name
            description
            forkCount
            pushedAt
            url
            isPrivate
            owner {
              login
            }
            stargazers {
              totalCount
            }
            licenseInfo {
              name
            }
            primaryLanguage {
              name
              color
            }
          }
        }
      }
    }
  }`;
  if (val.length <= 3 && val.length > 0) {
    wpr_listing.innerHTML = "Carregando...";
  } else {
    wpr_listing.innerHTML = "";
  }

  if (val.length > 3) {
    wpr_listing.innerHTML = `<h3>Repositórios</h3>
    <div class="user-repositories-list">
      <ul class="repositories-list-identifier"></ul>
    </div>`;
    fetchData(JSON.stringify({ query }));
  }
}

// FETCH FUNCTION
fetchData = (query, type = "repository") => {
  fetch("https://api.github.com/graphql", {
    method: "POST",
    headers: headers,
    body: query,
  })
    .then((res) => res.json())
    .then((fetchedData) => {
      console.log("RESULT DATA ==>", fetchedData);
      if (type === "repository") {
        const repositories = document.querySelector(
          ".repositories-list-identifier"
        );

        fetchedData.data.search.edges.forEach(
          (repository) =>
            (repositories.innerHTML += `<li>
              <div class="repository-details">
                <h3>
                  <a href="/repositorio/?u=${repository.node.owner.login}">${
              repository.node.name
            }</a>
                  ${
                    repository.node.isPrivate
                      ? `<span class="Private-label">Private</span>`
                      : ""
                  }
                </h3>
                <p class="description">
                  ${
                    repository.node.description
                      ? repository.node.description
                      : ""
                  }
                </p>
                <div class="language-and-timestamp">      
                ${
                  repository.node.primaryLanguage
                    ? `
                  <span class="repo-language">
                    <span class="language-color" style="background-color: ${repository.node.primaryLanguage.color}";></span>  
                    <span class="programming-language" > ${repository.node.primaryLanguage.name} </span>
                  </span>
                  `
                    : ""
                }
                ${
                  repository.node.stargazers.totalCount
                    ? `
                  <a class="star-count" href="#">
                    <svg aria-label="star" class="octicon octicon-star" viewBox="0 0 16 16" version="1.1" width="16" height="16" role="img"><path fill-rule="evenodd" d="M8 .25a.75.75 0 01.673.418l1.882 3.815 4.21.612a.75.75 0 01.416 1.279l-3.046 2.97.719 4.192a.75.75 0 01-1.088.791L8 12.347l-3.766 1.98a.75.75 0 01-1.088-.79l.72-4.194L.818 6.374a.75.75 0 01.416-1.28l4.21-.611L7.327.668A.75.75 0 018 .25zm0 2.445L6.615 5.5a.75.75 0 01-.564.41l-3.097.45 2.24 2.184a.75.75 0 01.216.664l-.528 3.084 2.769-1.456a.75.75 0 01.698 0l2.77 1.456-.53-3.084a.75.75 0 01.216-.664l2.24-2.183-3.096-.45a.75.75 0 01-.564-.41L8 2.694v.001z"></path></svg>
                    ${repository.node.stargazers.totalCount}
                  </a>`
                    : ""
                }
                ${
                  repository.node.parent
                    ? `
                  ${
                    repository.node.parent.forkCount
                      ? `
                    <a class="fork-count" href="#">
                      <svg aria-label="fork" class="octicon octicon-repo-forked" viewBox="0 0 16 16" version="1.1" width="16" height="16" role="img"><path fill-rule="evenodd" d="M5 3.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm0 2.122a2.25 2.25 0 10-1.5 0v.878A2.25 2.25 0 005.75 8.5h1.5v2.128a2.251 2.251 0 101.5 0V8.5h1.5a2.25 2.25 0 002.25-2.25v-.878a2.25 2.25 0 10-1.5 0v.878a.75.75 0 01-.75.75h-4.5A.75.75 0 015 6.25v-.878zm3.75 7.378a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm3-8.75a.75.75 0 100-1.5.75.75 0 000 1.5z"></path></svg> 
                      ${repository.node.parent.forkCount}
                    </a>
                    `
                      : ""
                  }`
                    : `
                  ${
                    repository.node.forkCount
                      ? `
                    <a class="fork-count" href="#">
                      <svg aria-label="fork" class="octicon octicon-repo-forked" viewBox="0 0 16 16" version="1.1" width="16" height="16" role="img"><path fill-rule="evenodd" d="M5 3.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm0 2.122a2.25 2.25 0 10-1.5 0v.878A2.25 2.25 0 005.75 8.5h1.5v2.128a2.251 2.251 0 101.5 0V8.5h1.5a2.25 2.25 0 002.25-2.25v-.878a2.25 2.25 0 10-1.5 0v.878a.75.75 0 01-.75.75h-4.5A.75.75 0 015 6.25v-.878zm3.75 7.378a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm3-8.75a.75.75 0 100-1.5.75.75 0 000 1.5z"></path></svg> 
                      ${repository.node.forkCount}
                    </a>
                    `
                      : ""
                  }
                `
                }
                <span class="timestamp">
                  ${getHumanTime(repository.node.pushedAt)}
                </span>
              </div>
            </div>
            <div class="repository-star">
             ${
               !checkFavorite(repository.node.id)
                 ? `
              <button class="btn" onClick="setToFavorite('${repository.node.id}')">
                <svg class="octicon octicon-star" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M8 .25a.75.75 0 01.673.418l1.882 3.815 4.21.612a.75.75 0 01.416 1.279l-3.046 2.97.719 4.192a.75.75 0 01-1.088.791L8 12.347l-3.766 1.98a.75.75 0 01-1.088-.79l.72-4.194L.818 6.374a.75.75 0 01.416-1.28l4.21-.611L7.327.668A.75.75 0 018 .25zm0 2.445L6.615 5.5a.75.75 0 01-.564.41l-3.097.45 2.24 2.184a.75.75 0 01.216.664l-.528 3.084 2.769-1.456a.75.75 0 01.698 0l2.77 1.456-.53-3.084a.75.75 0 01.216-.664l2.24-2.183-3.096-.45a.75.75 0 01-.564-.41L8 2.694v.001z"></path></svg>Star
              </button>
              `
                 : `<button class="btn" onClick="removeFavorite('${repository.node.id}')">
                    <svg version="1.1" class="octicon octicon-star" id="Layer_1" x="0px" y="0px"
                      width="16px" height="16px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
                      <polygon fill="gold" stroke="gold" stroke-width="37.6152" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="
                      259.216,29.942 330.27,173.919 489.16,197.007 374.185,309.08 401.33,467.31 259.216,392.612 117.104,467.31 144.25,309.08 
                      29.274,197.007 188.165,173.919 "/>
                    </svg>
                    Star
               </button>`
             }
            </div>
          </li>
        `)
        );
      }
    })
    .catch((err) => {
      console.log(err);
    });
};

setToFavorite = (id) => {
  let ids = [];
  let get_ids = localStorage.getItem("repo_ids");

  if (!get_ids) {
    ids.push(id);
    localStorage.setItem("repo_ids", JSON.stringify(ids));
  }

  if (get_ids) {
    ids = JSON.parse(get_ids);
    const get_id = ids.filter((item) => item === id);
    if (get_id != id) {
      ids.push(id);
      localStorage.setItem("repo_ids", JSON.stringify(ids));
    }
  }
  getRepositories();
};

removeFavorite = (id) => {
  let ids = [];
  let get_ids = localStorage.getItem("repo_ids");

  if (get_ids) {
    ids = JSON.parse(get_ids);
    get_ids = ids.filter((item) => item != id);
    localStorage.setItem("repo_ids", JSON.stringify(get_ids));
  }
  getRepositories();
};

checkFavorite = (id) => {
  let ids = [];
  let get_ids = localStorage.getItem("repo_ids");
  if (get_ids) {
    ids = JSON.parse(get_ids);
    const get_id = ids.filter((item) => item === id);
    if (get_id == id) {
      return true;
    }
  }
  return false;
};

filter_repositorios = () => {
  var input, filter, ul, li, a, i, txtValue;
  input = document.getElementById("filter");
  filter = input.value.toUpperCase();
  ul = document.getElementById("repositories_list");
  li = ul.getElementsByTagName("li");
  for (i = 0; i < li.length; i++) {
    a = li[i].getElementsByTagName("a")[0];
    txtValue = a.textContent || a.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
};

let getHumanTime = (vlaue) => {
  // MONTHS IN SHORT
  const shortMonths = [
    "",
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "May",
    "Jun",
    "July",
    "Aug",
    "Sep",
    "Oct",
    "Nov",
    "Dec",
  ];

  // GETTING CURRENT MONTHS USED FOR EVALUATION
  let currentMonth = new Date().getMonth();

  updatedAt = new Date(vlaue);

  let updatedAtMiliseconds = Date.parse(vlaue);
  let now = new Date().getTime();
  let timestamp = updatedAtMiliseconds - now;

  // CONVER TO APOSITIVE INTIGER
  let time = Math.abs(timestamp);

  // IF THERE ARE MONTHS
  if (time > 1000 * 60 * 60 * 24 * 30) {
    let months = parseInt(time / (1000 * 60 * 60 * 24 * 30), 10);
    if (months === 1) {
      humanTime = "Updated 1 month ago";
    } else {
      months = currentMonth + 1 - months;
      if (months >= 1) {
        months = shortMonths[months];
        humanTime = `Updated on ${months} ${updatedAt.getDate()}`;
      } else {
        months = shortMonths[updatedAt.getMonth() + 1];
        humanTime = `Updated on ${months} ${updatedAt.getDate()}, ${updatedAt.getFullYear()}`;
      }
    }
    return humanTime;
  }

  // IF THERE ARE DAYS
  else if (time > 1000 * 60 * 60 * 24) {
    let days = parseInt(time / (1000 * 60 * 60 * 24), 10);
    days === 1
      ? (days = `Updated yesterday`)
      : (days = `Updated ${days} days ago`);
    return days;
  }

  // IF THERE ARE HOURS
  else if (time > 1000 * 60 * 60) {
    let hours = parseInt(time / (1000 * 60 * 60), 10);
    hours === 1
      ? (hours = `Updated ${hours} hour ago `)
      : (hours = `Updated ${hours} Hours ago`);
    return hours;
  }

  // If THERE ARE MINUTES
  else if (time > 1000 * 60) {
    let minutes = parseInt(time / (1000 * 60), 10);
    minutes === 1
      ? (minutes = `Updated ${minutes} minute ago`)
      : (minutes = `Updated ${minutes} minutes ago`);
    return minutes;
  }

  // OTHER WISE USE SCONDS
  else {
    let seconds = parseInt(time / 1000, 10);
    seconds === 1
      ? (seconds = `Updated now`)
      : (seconds = `Updated ${seconds} seconds ago`);
    return seconds;
  }
};
