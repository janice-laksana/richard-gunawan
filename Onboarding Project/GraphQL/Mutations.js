import { gql } from "@apollo/client";

export const STAR_REPO = gql`
  mutation addStar($starrableId: ID!) {
    addStar(input: { starrableId: $starrableId }) {
      starrable {
        id
        stargazerCount
      }
    }
  }
`;

export const UNSTAR_REPO = gql`
  mutation removeStar($starrableId: ID!) {
    removeStar(input: { starrableId: $starrableId }) {
      starrable {
        id
        stargazerCount
      }
    }
  }
`;
