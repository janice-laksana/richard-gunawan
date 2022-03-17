import { gql } from "@apollo/client";

export const SEARCH_REPOSITORIES = gql`
  query searchRepositories(
    $name: String!
    $after: String
    $before: String
    $first: Int
    $last: Int
  ) {
    search(
      type: REPOSITORY
      query: $name
      first: $first
      last: $last
      after: $after
      before: $before
    ) {
      pageInfo {
        startCursor
        hasNextPage
        hasPreviousPage
        endCursor
      }
      repos: edges {
        repo: node {
          ... on Repository {
            id
            nameWithOwner
            description
            url
            allIssues: issues {
              totalCount
            }
            openIssues: issues(states: OPEN) {
              totalCount
            }
          }
        }
      }
    }
  }
`;

export const LOAD_REPOSITORIES = gql`
  query loadRepositories {
    user(login: "richardgunawan26") {
      id
      repositories(first: 10) {
        edges {
          node {
            id
            description
            name
            nameWithOwner
            url
            stargazerCount
          }
        }
      }
    }
  }
`;

export const LOAD_REPOSITORIY = gql`
  query loadRepository($id: ID!) {
    node(id: $id) {
      ... on Repository {
        id
        description
        nameWithOwner
        name
        url
        stargazerCount
        issues(last: 10, orderBy: { direction: ASC, field: CREATED_AT }) {
          edges {
            node {
              id
              createdAt
              title
              author {
                avatarUrl
                login
              }
              closed
              closedAt
              bodyHTML
              comments(first: 10) {
                edges {
                  node {
                    id
                    body
                    author {
                      login
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
  }
`;
