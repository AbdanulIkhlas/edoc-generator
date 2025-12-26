import { motion } from "framer-motion";
import type { GuestbookEntry as GuestbookEntryType } from "@/data/guestbook";

interface GuestbookEntryProps {
  entry: GuestbookEntryType;
  index: number;
}

const GuestbookEntry = ({ entry, index }: GuestbookEntryProps) => {
  const formattedDate = new Date(entry.timestamp).toLocaleDateString("en-US", {
    month: "short",
    day: "numeric",
  });

  return (
    <motion.div
      initial={{ opacity: 0, y: 20, scale: 0.95 }}
      animate={{ opacity: 1, y: 0, scale: 1 }}
      transition={{ delay: index * 0.05, duration: 0.4 }}
      className="p-4 rounded-xl bg-card border border-border hover:border-primary/20 transition-colors"
    >
      <div className="flex items-start gap-3">
        {entry.emoji && (
          <span className="text-2xl">{entry.emoji}</span>
        )}
        <div className="flex-1">
          <div className="flex items-center gap-2 mb-1">
            <span className="font-medium text-foreground">{entry.name}</span>
            <span className="text-xs text-muted-foreground">{formattedDate}</span>
          </div>
          <p className="text-muted-foreground text-sm leading-relaxed">
            {entry.message}
          </p>
        </div>
      </div>
    </motion.div>
  );
};

export default GuestbookEntry;
