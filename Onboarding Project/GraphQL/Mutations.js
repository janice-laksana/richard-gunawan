import { gql } from "@apollo/client";

export const STAR_REPO = gql`
  mutation addStar($starrableId: ID!) {
    addStar(input: { starrableId: $starrableId }) {
      starrable {
        id
        stargazerCount
        viewerHasStarred
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
        viewerHasStarred
      }
    }
  }
`;

export const SUBSCRIBE_REPO = gql`
  mutation subscribeRepo($subscribableId: ID!) {
    updateSubscription(
      input: { subscribableId: $subscribableId, state: SUBSCRIBED }
    ) {
      subscribable {
        viewerSubscription
      }
    }
  }
`;

export const UNSUBSCRIBE_REPO = gql`
  mutation unsubscribeRepo($subscribableId: ID!) {
    updateSubscription(
      input: { subscribableId: $subscribableId, state: UNSUBSCRIBED }
    ) {
      subscribable {
        viewerSubscription
      }
    }
  }
`;