export interface GuestbookEntry {
  id: string;
  name: string;
  message: string;
  emoji?: string;
  timestamp: string;
}

export const guestbookContent = {
  heading: "Guestbook",
  subheading: "Leave a message, say hello, share a thought",
  placeholder: "Write something nice...",
  namePlaceholder: "Your name",
  submitLabel: "Sign",
  emojiOptions: ["👋", "🚀", "✨", "💡", "🎨", "💻", "🌟", "❤️"],
};

export const initialGuestbookEntries: GuestbookEntry[] = [
  {
    id: "1",
    name: "Sarah K.",
    message: "Love the clean design! Your portfolio is inspiring.",
    emoji: "✨",
    timestamp: "2024-01-10T14:30:00Z",
  },
  {
    id: "2",
    name: "Marcus D.",
    message: "Great work on the animations. Smooth and purposeful!",
    emoji: "🚀",
    timestamp: "2024-01-08T09:15:00Z",
  },
  {
    id: "3",
    name: "Emily R.",
    message: "Fellow frontend dev here. Your projects are impressive!",
    emoji: "💻",
    timestamp: "2024-01-05T16:45:00Z",
  },
  {
    id: "4",
    name: "Jordan L.",
    message: "Met you at the React meetup. Glad to see your work online!",
    emoji: "👋",
    timestamp: "2024-01-02T11:20:00Z",
  },
  {
    id: "5",
    name: "Priya S.",
    message: "The attention to detail here is remarkable. Well done!",
    emoji: "🌟",
    timestamp: "2023-12-28T13:00:00Z",
  },
];
